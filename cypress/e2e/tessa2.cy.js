describe('Tessa E-commerce Site tests 2', () => {

    it('should increment and decrement quantities for 3 products in the shop using buttons, verify, and proceed to checkout', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('testuser@example.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.visit('/shop');

        // Iterate through the first 3 products
        for (let j = 0; j < 3; j++) {
            // Add the product to the cart with initial quantity of 1
            cy.get('.products-col-item').eq(j).within(() => {
                cy.get('button.default-btn').click();
            });

            // Increment by 20
            for (let i = 0; i < 20; i++) {
                cy.get('.products-col-item').eq(j).within(() => {
                    cy.get('.plus-btn').click();
                });
            }

            // Decrement by 5
            for (let i = 0; i < 5; i++) {
                cy.get('.products-col-item').eq(j).within(() => {
                    cy.get('.minus-btn').click();
                });
            }

            // Increment by 10
            for (let i = 0; i < 10; i++) {
                cy.get('.products-col-item').eq(j).within(() => {
                    cy.get('.plus-btn').click();
                });
            }

            // Decrement by 15
            for (let i = 0; i < 15; i++) {
                cy.get('.products-col-item').eq(j).within(() => {
                    cy.get('.minus-btn').click();
                });
            }

            // Increment by 2
            for (let i = 0; i < 2; i++) {
                cy.get('.products-col-item').eq(j).within(() => {
                    cy.get('.plus-btn').click();
                });
            }

            // Add the final quantity to the cart
            cy.get('.products-col-item').eq(j).within(() => {
                cy.get('button.default-btn').click();
            });
        }

        // Open the cart modal
        cy.get('.option-item .cart-btn a').first().click({ force: true });

        // Verify the cart modal is visible and the final quantity is correct for each product
        cy.get('#shoppingCartModal').should('be.visible');
        cy.get('.products-cart').each(($el) => {
            cy.wrap($el).within(() => {
                cy.get('.qnt-element').should('contain', '14');
            });
        });

        // Proceed to checkout directly from the modal
        cy.get('.products-cart-btn').within(() => {
            cy.get('.default-btn').contains('Checkout').click();
        });

        // Verify checkout page
        cy.url().should('include', '/checkout');
        cy.get('button[type="submit"]').contains('Place Order').click({ force: true });

        // Verify order confirmation
        cy.url().should('include', '/my-orders');
    });

    it('should increment and decrement product quantities in the shop using buttons, verify, and proceed to checkout', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('testuser@example.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.visit('/shop');

        // Add the first product to the cart with initial quantity of 1
        cy.get('.products-col-item').first().within(() => {
            cy.get('button.default-btn').click();
        });

        // Increment by 20
        for (let i = 0; i < 20; i++) {
            cy.get('.products-col-item').first().within(() => {
                cy.get('.plus-btn').click();
            });
        }
        // Decrement by 5
        for (let i = 0; i < 5; i++) {
            cy.get('.products-col-item').first().within(() => {
                cy.get('.minus-btn').click();
            });
        }


        // Increment by 10
        for (let i = 0; i < 10; i++) {
            cy.get('.products-col-item').first().within(() => {
                cy.get('.plus-btn').click();
            });
        }


        // Decrement by 15
        for (let i = 0; i < 15; i++) {
            cy.get('.products-col-item').first().within(() => {
                cy.get('.minus-btn').click();
            });
        }


        // Increment by 2
        for (let i = 0; i < 2; i++) {
            cy.get('.products-col-item').first().within(() => {
                cy.get('.plus-btn').click();
            });
        }
        cy.get('.products-col-item').first().within(() => {
            cy.get('button.default-btn').click();
        });

        // Open the cart modal
        cy.get('.option-item .cart-btn a').first().click({ force: true });

        // Verify the cart modal is visible and the final quantity is correct
        cy.get('#shoppingCartModal').should('be.visible');
        cy.get('.products-cart').first().within(() => {
            cy.get('.qnt-element').should('contain', '14');
        });

        // Proceed to checkout directly from the modal
        cy.get('.products-cart-btn').within(() => {
            cy.get('.default-btn').contains('Checkout').click();
        });

        // Verify checkout page
        cy.url().should('include', '/checkout');
        cy.get('button[type="submit"]').contains('Place Order').click({ force: true });

        // Verify order confirmation
        cy.url().should('include', '/my-orders');
    });

    it('should add 9 products to the cart, delete 3 products from the mycart modal, and proceed to checkout directly from the modal', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('testuser@example.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.visit('/shop');

        for (let i = 0; i < 9; i++) {
            // Add the product with quantity 16 to the cart
            cy.get('.products-col-item').eq(i).within(() => {
                cy.get('.qty-input').clear().type('16');
                cy.get('button.default-btn').click();
            });
        }

        // Open the cart modal
        cy.get('.option-item .cart-btn a').first().click({ force: true });

        // Verify the cart modal is visible
        cy.get('#shoppingCartModal').should('be.visible');

        // Delete 3 products from the cart modal
        cy.get('.products-cart').each(($el, index) => {
            if (index < 3) {
                cy.wrap($el).realHover();
                cy.wrap($el).find('.deleteCartitem').click({ force: true });
            }
        });

        // Ensure that there are only 6 products left in the cart modal
        cy.get('.products-cart').should('have.length', 6);

        // Proceed to checkout directly from the modal
        cy.get('.products-cart-btn').within(() => {
            cy.get('a').contains('Checkout').click();
        });

        // Verify checkout page
        cy.url().should('include', '/checkout');
        cy.get('button[type="submit"]').contains('Place Order').click({ force: true });

        // Verify order confirmation
        cy.url().should('include', '/my-orders');
    });

    it('should add 9 products to the cart, increment quantities, and proceed to checkout', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('testuser@example.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.visit('/shop');

        for (let i = 0; i < 9; i++) {
            // Add the product with quantity 16 to the cart
            cy.get('.products-col-item').eq(i).within(() => {
                cy.get('.qty-input').clear().type('16');
                cy.get('button.default-btn').click();
            });
        }

        // Open the cart modal
        cy.get('.option-item .cart-btn a').first().click({ force: true });

        // View the shopping cart
        cy.get('#shoppingCartModal').should('be.visible');
        cy.get('a').contains('View Shopping Cart').click();

        // Verify the cart page
        cy.url().should('include', '/cart');

        // Increment each product's quantity by 3
        cy.get('tbody tr').each(($el) => {
            cy.wrap($el).find('.plus-btn').click().click().click(); // Increment by 3
            cy.wait(1000);
        });

        // Proceed to checkout
        cy.get('.default-btn').contains('Checkout').click();
        cy.url().should('include', '/checkout');
        cy.get('button[type="submit"]').contains('Place Order').click({ force: true });

        // Verify order confirmation
        cy.url().should('include', '/my-orders');
    });

    it('should add 9 products to the cart, decrement quantities, and proceed to checkout', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('testuser@example.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.visit('/shop');

        for (let i = 0; i < 9; i++) {
            // Add the product with quantity 16 to the cart
            cy.get('.products-col-item').eq(i).within(() => {
                cy.get('.qty-input').clear().type('16');
                cy.get('button.default-btn').click();
            });
        }

        // Open the cart modal
        cy.get('.option-item .cart-btn a').first().click({ force: true });

        // View the shopping cart
        cy.get('#shoppingCartModal').should('be.visible');
        cy.get('a').contains('View Shopping Cart').click();

        // Verify the cart page
        cy.url().should('include', '/cart');

        // Increment each product's quantity by 3
        cy.get('tbody tr').each(($el) => {
            cy.wrap($el).find('.minus-btn').click().click().click(); // Increment by 3
            cy.wait(1000);
        });

        // Proceed to checkout
        cy.get('.default-btn').contains('Checkout').click();
        cy.url().should('include', '/checkout');
        cy.get('button[type="submit"]').contains('Place Order').click({ force: true });

        // Verify order confirmation
        cy.url().should('include', '/my-orders');
    });

    it('should add 9 products to the cart and delete 3 products', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('testuser@example.com');
        cy.get('input[name="password"]').type('password123');
        cy.get('button[type="submit"]').click();
        cy.visit('/shop');

        for (let i = 0; i < 9; i++) {
            // Add the product with quantity 16 to the cart
            cy.get('.products-col-item').eq(i).within(() => {
                cy.get('.qty-input').clear().type('16');
                cy.get('button.default-btn').click();
            });
        }

        // Open the cart modal
        cy.get('.option-item .cart-btn a').first().click({ force: true });

        // View the shopping cart
        cy.get('#shoppingCartModal').should('be.visible');
        cy.get('a').contains('View Shopping Cart').click();

        // Verify the cart page
        cy.url().should('include', '/cart');

        // Increment each product's quantity by 3
        // Delete 3 products from the cart
        cy.get('tbody tr').each(($el, index) => {
            if (index < 3) {
                cy.wrap($el).find('.remove').click();
            }
        });

        // Ensure that there are only 6 products left in the cart
        cy.get('tbody tr').should('have.length', 6);
        // Proceed to checkout
        cy.get('.default-btn').contains('Checkout').click();
        cy.url().should('include', '/checkout');
        cy.get('button[type="submit"]').contains('Place Order').click({ force: true });

        // Verify order confirmation
        cy.url().should('include', '/my-orders');
    });


});
