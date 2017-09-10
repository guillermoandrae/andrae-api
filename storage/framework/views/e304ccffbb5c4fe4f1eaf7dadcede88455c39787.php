<?php $__env->startSection('title', $post['title']); ?>

<?php $__env->startSection('description', $post['description']); ?>

<?php $__env->startSection('image', $post['image']); ?>

<?php $__env->startSection('url', sprintf('https://guillermoandraefisher.com/%s', $post['uri'])); ?>

<?php $__env->startSection('type', 'article'); ?>

<?php $__env->startSection('nav'); ?>
    <li><a href="/">Home</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Meta Header -->
    <header class="meta container text-center">
        <div class="row">
            <div class="post-source">
                <i class="fa fa-5x fa-<?php echo $post['source']; ?>"></i>
            </div>
            <time datetime="<?php echo $post['datetime']; ?>">Posted <?php echo $post['time']; ?></time>
        </div>
    </header>

    <!-- Post Section -->
    <section id="post" class="container text-center">
        <div class="row">
            <div class="section-content <?php echo $post['source']; ?> col-lg-8 col-lg-offset-2">
                <div class="post-thumbnail"><img src="<?php echo $post['image']; ?>"></div>
                <?php echo $post['body']; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>