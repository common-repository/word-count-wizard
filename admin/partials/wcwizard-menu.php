<?php

/**
 * This file is used to markup the menu of the plugin admin.
 *
 * @link       https://www.word-count-wizard.com
 * @since      2.1.0
 *
 * @package    wcwizard
 * @subpackage wcwizard/admin/partials
 */
?>
<?php
    $arr_wcwizard_quotes = array(

        array( 'quote' => '99.9% of great bloggers are not awesome on day 1. Their awesomeness is the accumulation of the value they create over time.', 'author' => 'Darren Rowse' ),
        array( 'quote' => 'I made a decision to write for my readers, not to try to find more readers for my writing.', 'author' => 'Seth Godin' ),
        array( 'quote' => 'People often ask me how am I able to write several blog posts in a day? My reply is simple: I eliminate all distractions and just write.', 'author' => 'Syed Balkhi' ),
        array( 'quote' => 'Writing is thinking out loud. Blogging is thinking out loud where other folks think back.', 'author' => 'Liz Strauss' ),
        array( 'quote' => 'A blog is a great way to figure out what you want to do with yourself because writing regularly is a path to self-discovery.', 'author' => 'Penelope Trunk' ),
        array( 'quote' => 'Your writing is the instruction manual for assembling ideas in your reader’s mind.', 'author' => 'Glen Long' ),
        array( 'quote' => 'It only takes one amazing post to push your blog past the tipping point.', 'author' => 'Matt Wolfe' ),
        array( 'quote' => 'The currency of blogging is authenticity and trust.', 'author' => 'Jason Calacanis' ),
        array( 'quote' => 'Potential brilliance can easily be stillborn when a writer wrestles with worry. Don’t.', 'author' => 'Mary Jaksch' ),

    );

    $statistics_link = array('<a href="'.admin_url('admin.php?page='.$this->plugin_name.'-settings').'">'.__('Settings', $this->plugin_name).'</a>');
?>

<div class="wcwizard-menu">
    <div>
        <a href="http://www.wp-wordcount-wizard.com/" title="Wordpress wordcount stats. A free translation tool by Wordcount Wizard"?>
        <img src="<?php echo plugins_url('/images/wizard-icon-mediano.png', dirname(__FILE__)); ?>" alt="Word Count Wizard" /></a>
    </div>

    <div>
        <?php include_once('wcwizard-admin-stats.php'); ?>
    </div>
</div>