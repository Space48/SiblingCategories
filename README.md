# Space48_SiblingCategories

While browsing a subcategory page on the current site there exists a list of sibling subcategories in the sidebar. 

This is not a filter, it is simply a list of link to the other sibling category pages. This means categories that belong to the same direct parent.

## Installation

**Manually** 

To install this module copy the code from this repo to `app/code/Space48/SiblingCategories` folder of your Magento 2 instance, then you need to run php `bin/magento setup:upgrade`

**Via composer**:

From the terminal execute the following:

`composer config repositories.space48-price-slider vcs git@github.com:Space48/SiblingCategories.git`

then

`composer require "space48/siblingcategories:dev-master"`
