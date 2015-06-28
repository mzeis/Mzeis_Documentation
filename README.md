Mzeis_Documentation
=====================
Create a documentation for your project in the backend.

Facts
-----
- Version: 1.0.0 (unreleased)
- [Extension on GitHub](https://github.com/mzeis/Mzeis_Documentation)

Compatibility
-------------
- Magento >= CE 1.9.1 (may also work in other versions)

Installation
------------
1. Install the extension using [Composer](https://getcomposer.org/) or
[modman](https://github.com/colinmollenhour/modman).

Uninstallation
--------------
1. Remove the files.
2. Remove the following database tables:
    * mzeis_documentation_page
3. Remove all entries in database table `core_config_data` starting with `path` `admin/mzeis_documentation/`.

Usage
-----
Navigate to `System > Documentation`. Start editing the homepage of the
documentation by clicking the `Edit` button.

###Permissions
You can define permissions for viewing, editing and deleting pages per admin user role (menu item
`System > Permissions > Users`, resource `System > Documentation`).

###Configuration
The configuration for this extension can be found in `System > Configuration > Advanced
> Admin`. Alternatively you also can click on the link `Configuration` in the documentation
menu.

####Set another page as the documentation homepage
By default, the documentation homepage is "Home". If you want to set another
page as the homepage, enter the name in `System > Configuration > Advanced
> Admin > Documentation > Homepage`.

###Editing a page
Go to `System > Documentation`, view any documentation page and click the `Edit` button
in the right top corner of the screen.

In the edit form, you can add content using the WYSIWYG editor.

You can insert images, variables and widgets. Note that widgets won't always display successfully
since you are viewing the page in the backend and not in the frontend which most widgets are made
for.

###Renaming a page
When viewing a page, click the `Rename` button in the top right corner. Choose a unique page name.
The links to the page will be renamed accordingly.

###Creating a new page
You create a new page by editing an existing page and adding a documentation link in this format:

    [[My new page]]

After saving, you will see a link to the page `My new page`. When you click on it you will be told
that there is no content for this page yet. Edit the new page to fill it with content.

###Searching
You can search through the documentation by using the search form in the left top corner. The
search searches for your term in the name and content of the documentation pages. The search
results are returned in an alphabetical manner.
 
###Showing all pages
Click on the documentation menu link `All pages` to get an overview over all pages.
 
###Orphan pages
It might happen that an existing pages isn't linked to anymore by any other pages when these
pages are changed. The documentation menu link `Orphan pages` will show you all pages without
links pointing at them.


Changelog
---------
[CHANGELOG.md](CHANGELOG.md)

Support
-------
If you have any issues with this extension, please create an issue on GitHub.
Please provide error messages, debug information like output from the Magento
error logs and the exact steps / code to reproduce thei ssue.

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to
open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).
Always create pull requests against the `dev` branch.

Author
------
Matthias Zeis ([matthias-zeis.com](http://www.matthias-zeis.com), [@mzeis](https://twitter.com/mzeis))

License
-------
[MIT License](LICENSE.md)

Copyright
---------
(c) 2015 Matthias Zeis
