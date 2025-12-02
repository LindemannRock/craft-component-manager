<?php
/**
 * Component Manager plugin for Craft CMS 5.x
 *
 * Advanced component management with folder organization, prop validation, and slots
 *
 * @link      https://lindemannrock.com
 * @copyright Copyright (c) 2025 LindemannRock
 */

namespace lindemannrock\componentmanager\twig;

use Twig\Node\Node;
use Twig\Node\TextNode;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Slot Token Parser
 *
 * Parses slot tags: {% slot:name %}content{% endslot %}
 *
 * @author    LindemannRock
 * @package   ComponentManager
 * @since     1.0.0
 */
class SlotTokenParser extends AbstractTokenParser
{
    /**
     * @inheritdoc
     */
    public function parse(Token $token): Node
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        
        // Parse slot name after the colon
        $slotName = 'default';
        if ($stream->nextIf(Token::PUNCTUATION_TYPE, ':')) {
            if ($stream->test(Token::NAME_TYPE)) {
                $slotName = $stream->next()->getValue();
            }
        }
        
        // Parse props if "with" keyword is present (for future use)
        $props = null;
        if ($stream->nextIf(Token::NAME_TYPE, 'with')) {
            $props = $this->parser->getExpressionParser()->parseExpression();
        }
        
        // Expect end of tag
        $stream->expect(Token::BLOCK_END_TYPE);
        
        // Parse body content until endslot
        $body = $this->parser->subparse(function(Token $token) {
            return $token->test('endslot');
        }, true);
        
        $stream->expect(Token::BLOCK_END_TYPE);
        
        // Return a simple TextNode for now - slots are processed by the component parser
        // In the future, this could be enhanced to handle slot props
        return new TextNode('', $lineno);
    }

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'slot';
    }
}
