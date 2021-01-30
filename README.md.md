# Ecommerce Website

## Project Description

Covid-19 has forced us all to change several aspects of our lives. It is now undesirable to leave home even for the simplest reasons unless they are essential. This has created a problem, especially for small businesses that deal with the non-essential good like sports equipment and clothing. To fight against this, these small companies had to shift their way of thinking and switch to online stores just to survive this pandemic.

## Expected Solution Description

A site for our sportswear store is needed. For now we will not be having online payments and ordering. It should just be a content management system and a site to reflect the content.

From the CMS site, there are only admins who will manage the contents of the website.
He/She should be able to:
1. Create and manage categories.
2. Create and manage items.
3. Create and manage admins.
4. Read messages sent by customer.

From the Site, the customer will be able to:
1. Browse the categories.
2. Browse all items under these categories.
3. Read item details.
4. Send a message to the admins.

## Categories
- Every category should have a name and an image
- The admin should be able add, edit, delete and fetch categories.
- Categories should be sorted alphabetically

APIs should be:
- GET /categories  For fetching all categories
- GET /category/{id} For getting specific category
- POST /category For storing new category
- PUT /category/{id} For Updating a category
- DELETE /category/{id} For deleting a category 

## Items
- Every item should have a name, price, description, and image.
- Every item should belong to one category.
- The admin should be able add, edit, delete and fetch items.
- The customer should be able to view all items based on categories.

APIs should be:
- GET /items  For fetching all items
- GET /item/{id} For getting specific item
- POST /item For storing new item
- PUT /item/{id} For Updating a item
- DELETE /item/{id} For deleting a item 

## Messages
- A customer can send a message to the admin containing the email, name, title and content.

APIs should be:
- GET /messages  For fetching all messages
- GET /message/{id} For getting specific message
- POST /message For storing new message
