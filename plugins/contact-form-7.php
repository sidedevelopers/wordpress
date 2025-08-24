<!-- Pdf download after contact form submit after <?php get_footer(); ?> in same page -->
<script>
	document.addEventListener('wpcf7mailsent', function(event) {
    	if (event.detail.contactFormId === 79) { // Use the numeric ID from your form URL
			const pdfUrl = 'https://www.bregano.in/wp-content/themes/bregano/img/Bregano_Catalogue.pdf';
			const link = document.createElement('a');
			link.href = pdfUrl;
			link.download = 'Bregano_Catalogue.pdf'; // Set desired filename
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		}
	});
</script>

<style>
/* for checkbox or radio button next line per item in pc devices */
@media only screen and (min-width: 768px) {
    .radiocheckbox .wpcf7-list-item {
        display: block;
        margin-bottom: 5px;
    }
}
</style>