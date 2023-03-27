<?php

namespace Xyron\Http;

/**
 * Http Methods.
 */
enum HttpMethod: string {
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
}
