# SiblingCategories
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Space48/SiblingCategories/badges/quality-score.png?b=master&s=06f68f1fb3bde0854e958cc9105bc75867c652d8)](https://scrutinizer-ci.com/g/Space48/SiblingCategories/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Space48/SiblingCategories/badges/build.png?b=master&s=db119b0846f72eac4e0ea527668767646a6af013)](https://scrutinizer-ci.com/g/Space48/SiblingCategories/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Space48/SiblingCategories/badges/coverage.png?b=master&s=73de43f17e5ae4c40ff604a4751ac9ea3d652206)](https://scrutinizer-ci.com/g/Space48/SiblingCategories/?branch=master)

While browsing a subcategory page on the current site there exists a list of sibling subcategories in the sidebar. 

This is not a filter, it is simply a list of link to the other sibling category pages. This means categories that belong to the same direct parent.

## Installation

**Manually** 

To install this module copy the code from this repo to `app/code/Space48/SiblingCategories` folder of your Magento 2 instance, then you need to run php `bin/magento setup:upgrade`

**Via composer**:

From the terminal execute the following:

`composer config repositories.space48-sibling-categories vcs git@github.com:Space48/SiblingCategories.git`

then

`composer require "space48/siblingcategories:{release-version}"`

## How to use it
Once installed, go to the `Admin Penel -> Stores -> Configuration -> Space48 -> Sibling Categories` and `enable` the extension.
