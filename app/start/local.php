<?php

//
Event::listen('creating: *', function ($view) {
	ppd($view);
});