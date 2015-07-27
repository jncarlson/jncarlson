<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Joseph Carlson - Portfolio</title>
        <meta name="Joseph Carlson" content="Portfolio & Résumé">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css">

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <?php require 'header.php' ?>
            <h2>Here's a few things I built.</h2>
            <h4 class="h4title" align="center"><i class="fa fa-github"></i> If you're looking for code samples, visit my <a
                    target="_blank" href="https://github.com/jncarlson">GitHub account.</a></h4>
            <div id="resume">
                <h3><strong>AngularJS, Javascript, PHP, SQL, HTML/CSS</strong>, <a target="_blank" href="http://bluebaron.net/#/overview/26137346/na">BlueBaron.net</a>.</h3>
                    <p>This is an application I own that I built in my free time. It uses AngularJS, Bootstrap, and Chartsjs.org for the front-end and a custom made API in PHP for the back-end. The
                       app also works closely with <a target="_blank" href="https://developer.riotgames.com/">Riots API</a> in order
                        to fetch important data for a players account. There have been over half a million unique visitors
                        and over 200 thousand accounts made. It's also the <a target="_blank"
                            href="https://www.reddit.com/r/summonerschool/comments/2x43l1/i_made_a_website_that_shows_summoners_exactly/">top post of all time on the league of legends subreddit.</a></p>
                <h3><strong>PHP</strong>, <a target="_blank" href="https://www.simplus.com/workfront/products/quickbooks/">Workfront + Quickbooks</a></h3>
                <p>Simplus's Workfront + Quickbooks product is an application that uses <a target="_blank" href="https://developer.intuit.com/apiexplorer?apiname=V3QBO">Quickbooks Online API</a>
                    and <a target="_blank" href="https://developers.workfront.com/api-docs/api-explorer/">WorkFronts API</a> to integrate the two platforms by syncing billing records, projects,
                    invoices, and a lot of other objects.</p>
                <h3><strong>Plain Javascript</strong>, Advanced Type-Ahead Search</h3>
                <p>One of the more popular selling products at Simplus is type-ahead search I built that expands the functionality of
                    <a target="_blank" href="https://select2.github.io/">Select2</a>. It has the added ability to filter
                by option group and return child objects, and filtering by child objects returns parent object. It's used
                    as an embedded page into workfront to copy any form value (that may have thousands of options) into any
                field on an object.</p>
                <h3><strong>Bootstrap, {LESS}, Twig, Javascript</strong>, <a target="_blank" href="https://www.itemexperts.com/">ItemExperts CMS</a></h3>
                <p>Item Experts have a Certified Management System that was originally built as a computer application. They need it to be converted into
                a SaaS app that has all the same functionality as the computer app. I was brought in towards the beginning of the project and have focused
                primarily on refactoring the styling sheets from long messy CSS to consolidated and semantic <a target="_blank"
                        href="http://lesscss.org/">LESS</a>. I also established a consistent and normalized layout structure for the entire
                front-end of the app.</p>
                <h3><strong>PHP</strong>, WordPress Auto-Builder</h3>
                <p>I made this script that can be uploaded into WordPress as a plugin and then used to auto-deploy over 30 different types of
                WordPress blogs. It formats everything into JSON array's and uses WordPress's native commands to insert the data in the correct
                fields. This script reduced the time to deploy a new blog from an average of 35 minutes, to an average of 6 minutes.</p>
                <h3><strong>Wordpress/Magento CMS</strong>, Custom Builds</h3>
                <p>
                    Okay, so I do know a <i>little</i> design. But it's not my preference. I designed and developed
                    <a target="_blank" href="http://bethanywiggins.com/">BethanyWiggins</a>, a portfolio website for a local young adult
                    author, and <a href="http://www.tinyblessings.com/">TinyBlessings</a>, a magento ecommerce site with the target
                    audience being grandparents.
                </p>
            </div>
        </div>
    </body>
</html>

<style type="text/css">
    .p-right li:nth-child(2) {
        font-weight: bold;
    }
</style>