<?php

 echo   $ffmpeg = trim(shell_exec('whereis  ffmpeg')); // or better yet:
$ffmpeg = trim(shell_exec('type -P ffmpeg'));

    if (empty($ffmpeg))
{
    die('ffmpeg not available');
}

shell_exec($ffmpeg . ' -i ...');?>