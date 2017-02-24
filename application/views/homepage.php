<section class="homepage-section">
    <div class="container">
        <?php if (!empty($popular_products)) { ?>
            <div class="row row-eq-height">
                <h2 class="title text-center">Cele mai populare</h2>
                <div class="row-height">
                <?php foreach ($popular_products as $product) { ?>
                    <?php $this->load->view('partials/product', ['product' => $product]); ?>
                <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>