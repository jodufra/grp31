<?php

/*
|--------------------------------------------------------------------------
| The Listeners File
|--------------------------------------------------------------------------
|	This gives us a nice separate location to store our event listeners.
|	To fire the event write, on your controller, some like this:
|	Event::fire(EventHandler::EVENT, array($newValueOfSomething));
|
*/
Event::listen(ExampleEventHandler::EVENT, 'ExampleEventHandler');

