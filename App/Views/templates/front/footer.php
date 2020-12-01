        
        <?php get_front_file("footer/subscribe"); ?>
        <footer class="footer-area bg-gray-4">
            <div class="footer-top border-bottom-4 pb-55">
                <div class="container">
                    <div class="row">
                       
                        <?php get_front_file("footer/categories"); ?>
                        <?php get_front_file("footer/links"); ?>
                        <?php get_front_file("footer/contact"); ?>
        
                    </div>
                </div>
            </div>

            <?php get_front_file("footer/bottom"); ?>

        </footer>
        <?php get_front_file("footer/model"); ?>
    </div>

    <!-- Core Vendors JS -->
    <script src="<?php echo get_script( 'vendors/vendor.front.min.js' ) ?>"></script>
    <!-- Core JS -->
    <script src="<?php echo get_script( 'vendors/plugins.front.min.js' ) ?>"></script>
    <!-- Main js -->
    <script src="<?php echo get_script( 'main.front.js' ) ?>"></script>
</body>
</html>