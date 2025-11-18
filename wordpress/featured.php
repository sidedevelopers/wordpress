“Featured” means highlighted, promoted, or given special importance.

When something is marked as Featured, it means:
✅ It is specially selected by the site owner or editor

Example:
Featured product → a product the store wants to promote
Featured blog post → an article they want readers to notice first

| Step             | What happens                                        |
| ---------------- | --------------------------------------------------- |
| 1. Add Meta Box  | Creates “Featured Post” box in post editor          |
| 2. Show Checkbox | Lets admins mark/unmark a post                      |
| 3. Save Meta     | Saves “_is_featured = yes” when checkbox is checked |
| 4. Fetch Posts   | WP_Query finds only posts marked as featured        |

--------------------------------------------------------------------------

⭐ 1️⃣ Add a Featured Checkbox to Post Editor

function add_featured_meta_box() {
    add_meta_box(
        'featured_post',
        'Featured Post',
        'featured_meta_box_html',
        'post'
    );
}
add_action('add_meta_boxes', 'add_featured_meta_box');

--------------------------------------------------------------------------

⭐ 2️⃣ Display the Checkbox in The Meta Box

function featured_meta_box_html($post) {
    $value = get_post_meta($post->ID, '_is_featured', true);
    ?>
    <label>
        <input type="checkbox" name="is_featured" <?php checked($value, 'yes'); ?>>
        Mark as Featured
    </label>
    <?php
}

--------------------------------------------------------------------------

⭐ 3️⃣ Save the Checkbox Value When Updating Post

function save_featured_meta($post_id) {
    if (isset($_POST['is_featured'])) {
        update_post_meta($post_id, '_is_featured', 'yes');
    } else {
        delete_post_meta($post_id, '_is_featured');
    }
}
add_action('save_post', 'save_featured_meta');

--------------------------------------------------------------------------

⭐ 4️⃣ Query Featured Posts

<?php
$featured_posts = new WP_Query(array(
    'post_type' => 'post',
    'meta_key'  => '_is_featured',
    'meta_value'=> 'yes',
    'posts_per_page' => 5,
));
?>

--------------------------------------------------------------------------

// Condition
<?php if ( get_post_meta(get_the_ID(), '_is_featured', true) === 'yes' ) { ?>
	<span class="badge text-bg-warning mb-2">Featured</span>
<?php } ?>

--------------------------------------------------------------------------

// ## Complete Code ##

<?php
// Add a Featured Checkbox to Post Editor
function add_featured_meta_box() {
    add_meta_box(
        'featured_post',
        'Featured Post',
        'featured_meta_box_html',
        'post'
    );
}
add_action('add_meta_boxes', 'add_featured_meta_box');

// Display the Checkbox in The Meta Box
function featured_meta_box_html($post) {
    $value = get_post_meta($post->ID, '_is_featured', true);
    ?>
    <label>
        <input type="checkbox" name="is_featured" <?php checked($value, 'yes'); ?>>
        Mark as Featured
    </label>
    <?php
}

// ⃣ Save the Checkbox Value When Updating Post
function save_featured_meta($post_id) {
    if (isset($_POST['is_featured'])) {
        update_post_meta($post_id, '_is_featured', 'yes');
    } else {
        delete_post_meta($post_id, '_is_featured');
    }
}
add_action('save_post', 'save_featured_meta');
?>