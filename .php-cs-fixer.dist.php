<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = new Finder()
    ->in(__DIR__);

return new Config("Code Style - PER-CS3x0 Custom")
    ->setRules([
        "@PER-CS3x0" => true,
        "braces_position" => false,
        "constant_case" => [
            "case" => "lower",
        ],
        "method_argument_space" => [
            "after_heredoc" => true,
        ],
        "modifier_keywords" => [
            "elements" => [
                "const",
                "method",
            ],
        ],
        "blank_lines_before_namespace" => [
            "max_line_breaks" => 2,
            "min_line_breaks" => 2,
        ],
        "no_extra_blank_lines" => [
            "tokens" => ["extra"],
        ],
        "ordered_types" => [
            "case_sensitive" => true,
        ],
        "single_blank_line_at_eof" => false,
        "single_line_empty_body" => false,
    ])
    ->setFinder($finder);