# PHP Diff

Diff is the abbreviation of difference. It is also the name of Unix/Linux
utility program that is able to compare two text files and shows the lines
that differ between them.

This class implements the same functionality of the diff commmand, except
that it is written in pure PHP, i.e. it does not require any external
programs or other PHP classes or scripts.

# Text Difference

You can compute the difference between two strings either line by
line, word by word or character by character.

In the case of finding differences between words or lines, you would
compare arrays of strings with the words or lines of the text.

# PHP Find Difference Between Two Strings

    require('diff.php');
 
    $before = 'Some text before';
    $after = 'This is the text after';
    
You can set the text mode option depending on whether you want to compare
text character by character ('c'), word by word ('w') or line by line
('l').
    
    $mode = 'w';

    $diff = new diff_class;

The class returns a difference object that contains the list of
differences between the two strings, as well may return a list of patch
operations to transform one string in to the other.
    
    if($diff->Diff($before, $after, &$difference))
      die('Diff error: '.$diff->error;);
      
# PHP Text Diff Highlight

If you want to highlight the differences between two strings in a Web page
you can use the FormatDiffAsHtml function instead, so it returns the first
string with <ins> and <del> tags showing what excepts of the string should
be removed or added to turn it into the second string.

    if($diff->FormatDiffAsHtml($before, $after, $difference)
        die('Diff error: '.$diff->error;);
    echo '<div>', $difference->html, '</div>';