<div class="text-center my-3">
    <?php echo paginate_links(); ?>
</div>

<style>
    .page-numbers {
        margin: 0px 4px;
        border: 1px solid var(--color-primary);
        padding: 4px 7px;
        background-color: var(--color-secondary);
    }
    .page-numbers:hover, .page-numbers.current {
        color: #fff;
        background-color: var(--color-primary);
    }
</style>