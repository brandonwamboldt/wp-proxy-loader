<?php

/**
 * Copyright (C) 2013 Brandon Wamboldt
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

foreach (glob(WPMU_PLUGIN_DIR . '/*') as $directory) {
    // glob() returns both files and folders, and WordPress will already load
    // the files by itself so ignore those.
    if (is_dir($directory)) {
        // So our directory looks like /wp-content/mu-plugins/<plugin-name>, so
        // we need to get <plugin-name> using basename
        $pluginName = basename($directory);

        // Get the two plugin formats we support
        $pluginFileClassic   = sprintf('%s/%s.php', $directory, $pluginName);
        $pluginFilePreferred = sprintf('%s/plugin.php', $directory);

        // Load the plugin file if it exists
        if (file_exists($pluginFilePreferred)) {
            require_once $pluginFilePreferred;
        } elseif (file_exists($pluginFileClassic)) {
            require_once $pluginFileClassic;
        }
    }
}

