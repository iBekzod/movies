comments
-id
-name
-parent_id
-timestamp
-uploads

uploads
$table->id();
$table->string('type');
$table->string('name');
$table->string('path');
$table->bigInteger('size');
$table->string('extension')->nullable();
$table->timestamps();

posts
-id
-parent_id
-name
-description
-cover_url
-video
-created_date


users
-id
...
-is_superuser
