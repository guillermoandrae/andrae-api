<?php $__env->startSection('title', 'The life and times of Guillermo A. Fisher'); ?>

<?php $__env->startSection('description', 'The life and times of Guillermo A. Fisher -- an aggregation of social media activity.'); ?>

<?php $__env->startSection('image', 'https://en.gravatar.com/userimage/68503725/4acdbc44d16dc6c0ea026eb107fcfa0b.png?size=200'); ?>

<?php $__env->startSection('url', 'https://guillermoandraefisher.com'); ?>

<?php $__env->startSection('type', 'website'); ?>

<?php $__env->startSection('nav'); ?>
    <li><a class="page-scroll" href="#page-top">Home</a></li>
    <li><a class="page-scroll" href="#timeline">Timeline</a></li>
    <li><a class="page-scroll" href="#about">About</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="section-content col-md-6">
                        <h1 class="brand-heading">I'm Guillermo.</h1>
                        <h2><span class="section-title">In so many words</span> &middot; Intro</h2>
                        <p>I attend church most Sundays. I, and the woman I love, have created several people. I spend my weekdays helping other people add code to the <abbr title="World Wide Web">WWW</abbr>. I sometimes use words to form strange phrases and &mdash; more frequently &mdash; full, mundane sentences.</p>
                    </div>
                    <div class="section-content col-md-offset-1 col-md-5">
                        <h2><span class="section-title">The Latest</span> &middot; Abridged Timeline</h2>
                        <p>I aggregate all of my social media activity because I can. You can see more below.</p>
                        <div class="latest-post">
                            <div class="post-source">
                                <i class="fa fa-2x fa-<?php echo $post['source']; ?>"></i>
                            </div>
                            <div class="post-summary">
                                <?php echo $post['summary']; ?>
                            </div>
                            <time datetime="<?php echo $post['datetime']; ?>"><?php echo $post['time']; ?></time>
                            <div class="post-action">
                                <?php echo $post['action']; ?>
                            </div>
                        </div>
                        <div id="more">
                            <a class="page-scroll" href="#timeline"><i class="fa fa-3x fa-chevron-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Timeline Section -->
    <section id="timeline" class="container text-center">
        <div class="row">
            <div class="section-content col-lg-8 col-lg-offset-2">
                <h2><span class="section-title">Comings & Goings</span> &middot; Timeline</h2>
                <table id="timeline-table"></table>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="container text-center">
        <div class="row">
            <div class="section-content col-lg-8 col-lg-offset-2">
                <h2><span class="section-title">The Skinny</span> &middot; About</h2>
                <h3>Colophon</h3>
                <h4>Continuous Delivery</h4>
                <p>The source code is stored in <a href="https://github.com">GitHub</a> in a repository entitled <a href="https://github.com/guillermoandrae/andrae">andrae</a>. <a href="https://codeship.com/">Codeship</a> is used to run tests against builds and deploy the code to multiple environments.</p>
                <h4>The Front-end</h4>
                <p>This presentation layer of this site is written in valid <abbr title="HyperText Markup Language">HTML</abbr>, <a href="http://lesscss.org/">Less</a>, and JavaScript. A free <a href="https://getbootstrap.com">Bootstrap</a> theme called <a href="https://startbootstrap.com/template-overviews/grayscale/">Grayscale</a> was used as the site's starting point. <a href="https://bower.io/">Bower</a> is used to manage the dependencies, which include <a href="https://jquery.com">jQuery</a>, <a href="http://fontawesome.io/">Font Awesome</a>, and others listed in the <code>bower.json</code> file.</p>
                <h4>The Back-end</h4>
                <p>The <a href="https://lumen.laravel.com/">Lumen</a> <abbr title="PHP: Hypertext Preprocessor">PHP</abbr> micro-framework was used to develop the server-side code. <a href="https://getcomposer.org">Composer</a> is used to manage the dependencies, which include <a href="https://phpunit.de/">PHPUnit</a>, <a href="http://docs.guzzlephp.org/en/stable/">Guzzle</a>, and others detailed in the <code>composer.json</code> file.</p>
                <h4>The Infrastructure</h4>
                <p>Several of the services provided by <abbr title="Amazon Web Services">AWS</abbr> are being used to support this site, including: <a href="https://aws.amazon.com/route53/">Route53</a>, <a href="https://aws.amazon.com/elasticbeanstalk/">Elastic Beanstalk</a> (and several supporting services such as <a href="https://aws.amazon.com/ec2/">EC2</a>, <a href="https://aws.amazon.com/elasticloadbalancing/">ELB</a>, etc.), and <a href="https://aws.amazon.com/dynamodb/">DynamoDb</a>. <a href="https://zapier.com">Zapier</a> sends all of my social network activity to the <abbr title="Application Programmable Interface">API</abbr>.</p>
                <h3>Contact</h3>
                <p>My inbox is cluttered; if you'd like to get in touch, do so at one of the following places:</p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-javascript'); ?>
    <!-- jQuery DataTables JavaScript -->
    <script src="/assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>

    <!-- MomentJS JavaScript -->
    <script src="/assets/vendor/moment/min/moment.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="/assets/js/grayscale.js"></script>

    <!-- Theme JavaScript -->
    <script src="/assets/js/timeline.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>