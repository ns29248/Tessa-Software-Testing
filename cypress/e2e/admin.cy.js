describe('Admin Categories Management', () => {
    beforeEach(() => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('admin@admin.com');
        cy.get('input[name="password"]').type('password');
        cy.get('button[type="submit"]').click();
        cy.url().should('include', '/admin/dashboard');

    });
    it('should add a new category', () => {
        cy.visit('/categories');
        // Fill out the form and submit
        cy.get('input[name="name"]').type('Test Category');
        cy.get('button[type="submit"]').contains('Add Category').click();
        // Check for success message
        cy.contains('Category created successfully').should('be.visible');

    });
    it('should edit the newly created category', () => {
        cy.visit('/categories');
        // Find the newly created category and click the edit button
        cy.contains('Test Category').parent().within(() => {
            cy.get('a.btn.btn-primary.btn-sm').contains('Edit').click();
        });

        // Update the category name and submit
        cy.get('input[name="name"]').clear().type('Updated Categoryyyy');
        cy.get('button[type="submit"]').contains('Update Category').click();

        // Check for success message
        cy.contains('Category updated successfully').should('be.visible');

    });

    it('should delete the updated category', () => {
        cy.visit('/categories');
        // Find the updated category and click the delete button
        cy.contains('Updated Categoryyyy').parent().within(() => {
            cy.get('form').within(() => {
                cy.get('button[type="submit"]').contains('Delete').click({ force: true });
            });
        });

        // Confirm the deletion
        cy.on('window:confirm', () => true);

        // Check for success message
        cy.contains('Category deleted successfully').should('be.visible');

        // Verify the category no longer appears in the table
        cy.contains('Updated Categoryyyy').should('not.exist');
    });
    it('should add a new brand', () => {
        cy.visit('/brands');
        // Fill out the form and submit
        cy.get('input[name="name"]').type('Test Brand');
        cy.get('button[type="submit"]').contains('Add Brand').click();

        // Check for success message
        cy.contains('Brand created successfully').should('be.visible');
    });

    it('should edit the newly created brand', () => {
        cy.visit('/brands');

        // Find the newly created brand and click the edit button
        cy.contains('Test Brand').parent().within(() => {
            cy.get('a.btn.btn-primary.btn-sm').contains('Edit').click();
        });

        // Update the brand name and submit
        cy.get('input[name="name"]').clear().type('Updated Brandyyy');
        cy.get('button[type="submit"]').contains('Update Brand').click();

        // Check for success message
        cy.contains('Brand updated successfully').should('be.visible');

    });

    it('should delete the updated brand', () => {
        cy.visit('/brands');

        // Find the updated brand and click the delete button
        cy.contains('Updated Brandyyy').parent().within(() => {
            cy.get('form').within(() => {
                cy.get('button[type="submit"]').contains('Delete').click({ force: true });
            });
        });

        // Confirm the deletion
        cy.on('window:confirm', () => true);

        // Check for success message
        cy.contains('Brand deleted successfully').should('be.visible');

        // Verify the brand no longer appears in the table
        cy.contains('Updated Brandyyy').should('not.exist');
    });

    it('should add a new product', () => {
        cy.visit('/products');
        // Fill out the form
        cy.get('input[name="name"]').type('Test Product');
        cy.get('textarea[name="description[en]"]').type('Test product description in English.');
        cy.get('textarea[name="description[mk]"]').type('Test product description in Macedonian.');
        cy.get('textarea[name="description[shq]"]').type('Test product description in Albanian.');
        cy.get('input[name="quantity"]').type('10');
        cy.get('input[name="price"]').type('100');
        cy.get('input[name="stylist_price"]').type('80');

        // Select a brand and category (assuming the first options are valid)
        cy.get('select[name="brand_id"]').select(1);
        cy.get('select[name="category_id"]').select(1);

        // Upload an image
        cy.get('input[type="file"]').attachFile('fff.png'); // Adjust the path to your test image file

        // Submit the form
        cy.get('button[type="submit"]').contains('Add Product').click();

        // Check for success message
        cy.contains('Product Added Successfully').should('be.visible');
    });

    it('should edit the newly created product', () => {
        cy.visit('/products');

        // Find the newly created product and click the edit button
        cy.contains('Test Product').parent().within(() => {
            cy.get('a.btn.btn-primary.btn-sm').contains('Edit').click();
        });

        // Update the product name and submit
        cy.get('input[name="name"]').clear().type('Updated Product');
        cy.get('textarea[name="description[en]"]').clear().type('Updated product description in English.');
        cy.get('textarea[name="description[mk]"]').clear().type('Updated product description in Macedonian.');
        cy.get('textarea[name="description[shq]"]').clear().type('Updated product description in Albanian.');
        cy.get('input[name="quantity"]').clear().type('20');
        cy.get('input[name="price"]').clear().type('200');
        cy.get('input[name="stylist_price"]').clear().type('150');

        // Submit the form
        cy.get('button[type="submit"]').contains('Update Product').click();

        // Check for success message
        cy.contains('Product Updated Successfully').should('be.visible');

    });

    it('should delete the updated product', () => {
        cy.visit('/products');

        // Find the updated product and click the delete button
        cy.contains('Updated Product').parent().within(() => {
                cy.get('button[type="submit"]').contains('Delete').click({ force: true });
        });

        // Confirm the deletion
        cy.on('window:confirm', () => true);

        // Check for success message
        cy.contains('Product Deleted Successfully').should('be.visible');

    });
    it('should add a product to sale successfully', () => {
        // Navigate to the "Add Product to Sale" page
        // Assuming you have the product ID or a way to navigate to this page
        cy.visit('/products'); // Adjust the URL to your admin products page
        cy.contains('Add to Sale').click(); // Click on "Add to Sale" for the desired product

        // Fill out the form
        cy.get('input[name="sale_price"]').type('50');
        cy.get('input[name="start_date"]').type('2024-07-01');
        cy.get('input[name="end_date"]').type('2024-07-31');

        // Submit the form
        cy.get('button[type="submit"]').contains('Add to Sale').click();

        // Check for success message
        cy.contains('Sale added successfully.').should('be.visible');
    });


});
