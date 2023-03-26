<?php

namespace Xyron\Http;

// Cuando se llame a un enum, este devolvera un string (su value es de tipo string)
enum ContentType: string {
    case Json = "application/json";
    case Text = "text/plain";
    case Html = "text/html";
}