<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| Definitions of all the Page Components
| WITH a trailing slash:
|
|
|
*/

$config['component_definition'] = array(
                                    "video|library" => array(
                                                            "determinate" => 1,
                                                            "determinate_verb" => "completed",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "video|embed" => array(
                                                            "determinate" => 0,
                                                            "determinate_verb" => "",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "video|link" => array(
                                                            "determinate" => 1,
                                                            "determinate_verb" => "completed",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "video|youtube" => array(
                                                            "determinate" => 0,
                                                            "determinate_verb" => "",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "text|text" => array(
                                                            "determinate" => 0,
                                                            "determinate_verb" => "",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "image|library" => array(
                                                            "determinate" => 1,
                                                            "determinate_verb" => "viewed",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "audio|library" => array(
                                                            "determinate" => 1,
                                                            "determinate_verb" => "completed",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "link|link" => array(
                                                        "determinate" => 1,
                                                        "determinate_verb" => "viewed",
                                                        "counting_verb" => "viewed"
                                                    ),
                                    "document|library" => array(
                                                                "determinate" => 1,
                                                                "determinate_verb" => "viewed",
                                                                "counting_verb" => "viewed"
                                                            ),
                                    "document|link" => array(
                                                            "determinate" => 1,
                                                            "determinate_verb" => "viewed",
                                                            "counting_verb" => "viewed"
                                                        ),
                                    "quick_check|questions" => array(
                                                                    "determinate" => 1,
                                                                    "determinate_verb" => "answered",
                                                                    "counting_verb" => "answered"
                                                                ),
                                    "question|questions" => array(
                                                                    "determinate" => 1,
                                                                    "determinate_verb" => "answered",
                                                                    "counting_verb" => "answered"
                                                                ),
                                    "assessment|assessments" => array(
                                                                    "determinate" => 0,
                                                                    "determinate_verb" => "answered",
                                                                    "counting_verb" => "answered"
                                                                )
                                );

