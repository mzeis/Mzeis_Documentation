General
===

<a name="usage"></a>Usage
---
Navigate to `System > Documentation`.

Start editing the homepage of the documentation by clicking the `Edit` button or
read through the existing project and module documentation.

<a name="difference-project-module-documentation"></a>Difference between project and module documentation
---
You might be wondering: why all the fuzz about "project" and "module"?

###Project documentation

The project documentation is meant to contain all information specific to your very project. It may be written by
different parts of the project team like the merchant, marketing staff, developers, devops or whoever is part of the
team.

This documentation should be accessible to these parties both for viewing and editing so it can be updated quickly. It
can hold information on pretty much anything regarding your e-commerce business.

###Module documentation

The module documentation on the other part is something usually maintained by the module developers. It may (and should)
include usage information but is primarily written from and for developers. As such, it should reflect the current
(technical) state of a certain module.

Developers like to keep their documentation in markdown files. This documentation extension both provides reading module
documentation from Markdown files and documentation in the database.

Module documentation is available to the parties mentioned above but cannot be modified in the backend.

<a name="permissions"></a>Permissions
---
You can define permissions for viewing, editing and deleting pages per admin user role (menu item
`System > Permissions > Users`, resource `System > Documentation`).

<a name="configuration"></a>Configuration
---
The configuration for this extension can be found in `System > Configuration > Advanced > Admin`. Alternatively you also
can click on the link `Configuration` in the documentation menu on the left.

<a name="set-homepage"></a>Set another page as the documentation homepage
---
By default, the documentation homepage is "Home". If you want to set another page as the homepage, enter the name in
`System > Configuration > Advanced > Admin > Documentation > Homepage`.

<a name="search"></a>Searching
---
You can search through the documentation by using the search form in the left top corner. The
search searches for your term in the name and content of the documentation pages. The search
results are returned in an alphabetical manner.

<a name="all-pages"></a>Showing all pages
---
Click on the documentation menu link `All pages` to get an overview over all pages.
