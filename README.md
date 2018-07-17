# Orbis Websites

## Queries

```
SELECT
	website_post.ID,
	website_post.post_title,
	subscription.name,
	subscription.activation_date
FROM
	wp_posts AS website_post
		LEFT JOIN
	orbis_subscriptions AS subscription
			ON subscription.name = website_post.post_title
		LEFT JOIN
	orbis_subscription_types AS subscription_product
			ON subscription.type_id = subscription_product.id
WHERE
	website_post.post_type = 'orbis_website' 
		AND
	website_post.post_status = 'publish'
		AND
	subscription_product.name LIKE '%WordPress onderhoud en support%'
;
```

```
SELECT
	subscription_product.name,
	subscription_product.price,
	subscription.name,
	subscription.activation_date,
	website_post.ID,
	website_post.post_title
FROM
	orbis_subscriptions AS subscription
		LEFT JOIN
	orbis_subscription_types AS subscription_product
			ON subscription.type_id = subscription_product.id
		LEFT JOIN
	wp_posts AS website_post
			ON (
				subscription.name = website_post.post_title
					AND
				website_post.post_type = 'orbis_website'
					AND
				website_post.post_status = 'publish'
			)
WHERE
	(
		subscription.cancel_date IS NULL
			OR
		subscription.expiration_date > NOW()
	)
		AND
	subscription_product.name LIKE '%WordPress onderhoud en support%'
;
```
