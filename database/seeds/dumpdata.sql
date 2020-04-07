INSERT INTO `box_recipes` (`id`, `user_box_id`, `created_at`, `updated_at`, `recipe_id`) VALUES
(1, 1, NULL, NULL, 1),
(2, 1, NULL, NULL, 2),
(3, 1, NULL, NULL, 3),
(4, 1, NULL, NULL, 2),
(5, 1, NULL, NULL, 3),
(6, 1, NULL, NULL, 4),
(7, 1, NULL, NULL, 2),
(8, 1, NULL, NULL, 3),
(9, 1, NULL, NULL, 4),
(10, 1, NULL, NULL, 5),
(11, 1, NULL, NULL, 3),
(12, 1, NULL, NULL, 8),
(13, 1, NULL, NULL, 5),
(14, 1, NULL, NULL, 7),
(15, 1, NULL, NULL, 8),
(16, 1, NULL, NULL, 2),
(17, 1, NULL, NULL, 7),
(18, 1, NULL, NULL, 8),
(19, 1, NULL, NULL, 2),
(20, 1, NULL, NULL, 8),
(21, 1, NULL, NULL, 8),
(22, 1, NULL, NULL, 8);

INSERT INTO `ingredients` (`id`, `name`, `measure`, `supplier`, `created_at`, `updated_at`) VALUES
(1, 'Onion', 'kg', 'Xyz', '2020-04-07 03:43:03', NULL),
(2, 'Tomatoe', 'kg', 'Xyz', '2020-04-07 03:43:16', NULL),
(3, 'Garlic', 'g', 'ABC', '2020-04-07 03:43:40', NULL),
(4, 'Flour', 'kg', 'ABC', '2020-04-07 03:43:59', NULL),
(5, 'Chicken', 'pieces', 'YYZ', '2020-04-07 03:44:17', NULL),
(6, 'Steak', 'pieces', 'YYZ', '2020-04-07 03:44:33', NULL),
(7, 'Rice', 'kg', 'MMK', '2020-04-07 03:44:53', NULL),
(8, 'Salt', 'g', 'BBA', '2020-04-07 03:45:36', NULL);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_04_07_042351_create_ingredients_table', 1),
(4, '2020_04_07_042438_create_recipes_table', 1),
(5, '2020_04_07_042508_create_recipe_ingredients_table', 1),
(6, '2020_04_07_042639_create_user_box_table', 1),
(7, '2020_04_07_043623_create_box_recipes_table', 1),
(8, '2020_04_07_054042_add_quantity_column_to_recipe_ingredients_table', 1),
(9, '2020_04_07_072843_add_recipe_id_to_box_recipes_table', 1);

INSERT INTO `recipes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Recipe 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:48:35', NULL),
(2, 'Recipe 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:48:59', NULL),
(3, 'Recipe 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:49:05', NULL),
(4, 'Recipe 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:49:20', NULL),
(5, 'Recipe 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:49:23', NULL),
(6, 'Recipe 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:49:36', NULL),
(7, 'Recipe 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:49:39', NULL),
(8, 'Recipe 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit gravida nibh. Nullam sed condimentum nibh, vitae aliquet mi.', '2020-04-07 03:49:44', NULL);

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `ingredient_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, NULL, NULL),
(2, 1, 3, 5, NULL, NULL),
(3, 1, 6, 4, NULL, NULL),
(4, 2, 4, 2, NULL, NULL),
(5, 2, 8, 5, NULL, NULL),
(6, 2, 5, 4, NULL, NULL),
(7, 3, 4, 2, NULL, NULL),
(8, 3, 8, 5, NULL, NULL),
(9, 3, 5, 4, NULL, NULL),
(10, 4, 4, 2, NULL, NULL),
(11, 4, 2, 6, NULL, NULL),
(12, 4, 5, 4, NULL, NULL),
(13, 5, 4, 2, NULL, NULL),
(14, 5, 2, 6, NULL, NULL),
(15, 5, 5, 4, NULL, NULL),
(16, 6, 4, 2, NULL, NULL),
(17, 6, 3, 6, NULL, NULL),
(18, 6, 6, 7, NULL, NULL),
(19, 7, 4, 2, NULL, NULL),
(20, 7, 3, 6, NULL, NULL),
(21, 7, 6, 7, NULL, NULL),
(22, 8, 1, 2, NULL, NULL),
(23, 8, 3, 6, NULL, NULL),
(24, 8, 6, 7, NULL, NULL);

INSERT INTO `user_box` (`id`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, '2020-04-10', NULL, NULL),
(2, '2020-04-12', NULL, NULL),
(3, '2020-04-20', NULL, NULL),
(4, '2020-04-15', NULL, NULL),
(5, '2020-04-14', NULL, NULL),
(6, '2020-04-11', NULL, NULL),
(7, '2020-04-25', NULL, NULL);
