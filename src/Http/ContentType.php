<?php

namespace Xyron\Http;

/**
 * Header Content Type
 */
enum ContentType: string {
    /**
     * JSON Header
     */
    case Json = "application/json";
    /**
     * Text Header
     */
    case Text = "text/plain";
    /**
     * HTML Header
     */
    case Html = "text/html";
}