<?php
function sqlReplace($text)
{
    $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out anything between the javascript tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );

    $text = preg_replace($search, '', $text);

    //read here about this function - http://php.net/manual/en/function.htmlspecialchars.php
    $text = htmlspecialchars($text, ENT_QUOTES);
    
    return $text;
} 

function spamcheck($field)
{
    //filter_var() sanitizes the e-mail
    //address using FILTER_SANITIZE_EMAIL
    $field=filter_var($field, FILTER_SANITIZE_EMAIL);

    //filter_var() validates the e-mail
    //address using FILTER_VALIDATE_EMAIL
    if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}
?>