<?php
/**
 * Twig Component Manager plugin for Craft CMS 5.x
 *
 * Advanced Twig component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\twigcomponentmanager\twig;

use lindemannrock\twigcomponentmanager\TwigComponentManager;
use Twig\Error\SyntaxError;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Component Token Parser
 *
 * Parses the preprocessed component syntax:
 * {% x:component-name with {prop: 'value'} %}content{% endx:component-name %}
 *
 * @author    LindemannRock
 * @package   TwigComponentManager
 * @since     1.0.0
 */
class ComponentTokenParser extends AbstractTokenParser
{
    /**
     * @var string|null Component name being parsed
     */
    private ?string $componentName = null;
    
    /**
     * @var TwigComponentManager
     */
    private TwigComponentManager $plugin;

    /**
     * Constructor
     *
     * @param TwigComponentManager $plugin
     */
    public function __construct(TwigComponentManager $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @inheritdoc
     */
    public function parse(Token $token): Node
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        
        // Parse component name after the colon
        // The tag is 'x' and we expect ':componentname'
        $this->componentName = null;
        
        if ($stream->nextIf(Token::PUNCTUATION_TYPE, ':')) {
            // Get the component name
            $this->componentName = $this->parseComponentName();
        }
        
        // Parse props if "with" keyword is present
        $props = null;
        if ($stream->nextIf(Token::NAME_TYPE, 'with')) {
            $props = $this->parser->getExpressionParser()->parseExpression();
        }
        
        // Expect end of tag
        $stream->expect(Token::BLOCK_END_TYPE);
        
        // Parse body content until end tag
        $body = null;
        $slots = [];
        
        // Check if this is a self-closing tag (immediate end tag)
        if ($stream->test(Token::BLOCK_START_TYPE)) {
            $next = $stream->look(1);
            if ($next && $next->test(Token::NAME_TYPE) && $next->getValue() === 'endx') {
                // Self-closing, no body
                $stream->next(); // consume block start
                $stream->expect(Token::NAME_TYPE, 'endx');
                $stream->expect(Token::BLOCK_END_TYPE);
            } else {
                // Has body content
                $body = $this->parseBody($stream, $slots);
            }
        } else {
            // Has body content
            $body = $this->parseBody($stream, $slots);
        }
        
        return new ComponentNode($this->componentName, $props, $body, $slots, $lineno, $this->getTag());
    }
    
    /**
     * Parse component body and slots
     *
     * @param \Twig\TokenStream $stream
     * @param array &$slots
     * @return Node|null
     */
    private function parseBody($stream, array &$slots): ?Node
    {
        $test = function(Token $token) {
            // Check for end tag
            if ($token->test(Token::NAME_TYPE)) {
                $value = $token->getValue();
                
                // Check for component end tag (just 'endx' now)
                if ($value === 'endx') {
                    return true;
                }
                
                // Check for slot tags
                if (str_starts_with($value, 'slot:') || $value === 'endslot') {
                    return true;
                }
            }
            return false;
        };
        
        $body = [];
        $currentSlot = null;
        $slotContent = [];
        
        while (!$stream->test(Token::EOF_TYPE)) {
            // Check for special tags
            if ($stream->test(Token::BLOCK_START_TYPE)) {
                $next = $stream->look(1);
                
                if ($next && $next->test(Token::NAME_TYPE)) {
                    $value = $next->getValue();
                    
                    // Check for end of component
                    if ($value === 'endx') {
                        // Save any pending slot
                        if ($currentSlot !== null) {
                            $slots[$currentSlot] = new Node($slotContent);
                            $slotContent = [];
                            $currentSlot = null;
                        }
                        
                        // Consume end tag
                        $stream->next(); // block start
                        $stream->expect(Token::NAME_TYPE, 'endx');
                        $stream->expect(Token::BLOCK_END_TYPE);
                        break;
                    }
                    
                    // Check for slot start
                    if (str_starts_with($value, 'slot:')) {
                        // Save previous slot if any
                        if ($currentSlot !== null) {
                            $slots[$currentSlot] = new Node($slotContent);
                            $slotContent = [];
                        } elseif (!empty($body)) {
                            // Save default content before first slot
                            $slots['default'] = new Node($body);
                            $body = [];
                        }
                        
                        // Start new slot
                        $currentSlot = substr($value, 5); // Remove "slot:"
                        $stream->next(); // block start
                        $stream->expect(Token::NAME_TYPE, $value);
                        $stream->expect(Token::BLOCK_END_TYPE);
                        continue;
                    }
                    
                    // Check for slot end
                    if ($value === 'endslot') {
                        if ($currentSlot !== null) {
                            $slots[$currentSlot] = new Node($slotContent);
                            $slotContent = [];
                            $currentSlot = null;
                        }
                        
                        $stream->next(); // block start
                        $stream->expect(Token::NAME_TYPE, 'endslot');
                        $stream->expect(Token::BLOCK_END_TYPE);
                        continue;
                    }
                }
            }
            
            // Parse content
            $node = $this->parser->subparse($test, false);
            
            if ($currentSlot !== null) {
                $slotContent[] = $node;
            } else {
                $body[] = $node;
            }
        }
        
        // If we have slots but no default, and there's body content, make it default
        if (!empty($slots) && !isset($slots['default']) && !empty($body)) {
            $slots['default'] = new Node($body);
            $body = [];
        }
        
        return !empty($body) ? new Node($body) : null;
    }
    
    /**
     * Parse the component name from the token stream
     * Handles names like "button", "showcase-button", or "forms/contact-card"
     *
     * @return string
     */
    private function parseComponentName(): string
    {
        $stream = $this->parser->getStream();
        $name = '';
        $expectingPart = true;
        
        while (true) {
            // Get name part
            if ($expectingPart && $stream->test(Token::NAME_TYPE)) {
                $name .= $stream->next()->getValue();
                $expectingPart = false;
            }
            // Handle hyphen in component name
            elseif (!$expectingPart && $stream->test(Token::OPERATOR_TYPE, '-')) {
                $stream->next(); // consume the hyphen
                $name .= '-';
                $expectingPart = true;
            }
            // Handle path separator
            elseif (!$expectingPart && $stream->test(Token::OPERATOR_TYPE, '/')) {
                $stream->next(); // consume the slash
                $name .= '/';
                $expectingPart = true;
            }
            else {
                break;
            }
        }
        
        if (empty($name)) {
            throw new SyntaxError('Component name is required after "x:"', 
                $stream->getCurrent()->getLine(), 
                $stream->getSourceContext());
        }
        
        return $name;
    }

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'x';
    }
}