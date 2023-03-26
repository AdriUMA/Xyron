<?php

namespace Xyron;

// Cuando se llame a un enum, este devolvera un string (su value es de tipo string)
enum HttpMethod: string {
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
}