<?php $__env->startSection('title', 'Page not found'); ?>

<?php $__env->startSection('description', 'Page not found'); ?>

<?php $__env->startSection('image', ''); ?>

<?php $__env->startSection('url', 'https://guillermoandraefisher.com'); ?>

<?php $__env->startSection('type', 'website'); ?>

<?php $__env->startSection('nav'); ?>
    <li><a href="/">Home</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Meta Header -->
    <header class="meta container text-center">
        <div class="row">
            <div class="post-source">
                <i class="fa fa-5x fa-warning"></i>
            </div>
        </div>
    </header>

    <!-- Post Section -->
    <section id="post" class="container text-center">
        <div class="row">
            <div class="section-content error col-lg-8 col-lg-offset-2">
                Welcome to Nowhere. Enjoy.
                <iframe src="https://www.youtube.com/embed/rSeS9Oh1mds" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>