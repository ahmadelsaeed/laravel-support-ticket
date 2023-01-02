<?php

namespace Coderflex\LaravelTicket\Enums;

enum Status: int
{
    case OPEN = 0;
    case UNPROCESSED = 1;
    case WAITDEPARTMENTRESPONSE = 2;
    case SOLVED = 3;
    case CLOSED = 4;
}
