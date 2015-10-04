Project Documentation
===

<a name="editing-page"></a>Editing a page
---
Go to `System > Documentation`, view any documentation page and click the `Edit` button
in the right top corner of the screen.

In the edit form, you can add content using the WYSIWYG editor.

You can insert images, variables and widgets. Note that widgets won't always display successfully
since you are viewing the page in the backend and not in the frontend which most widgets are made
for.

<a name="choosing-format"></a>Choosing the format
---
You can write the content of a page in **Magento-flavoured HTML** or **Markdown**. Set the format by selecting `HTML` or
`Markdown` in the page edit form dropdown.

###Magento-flavoured HTML

You will get the well-known Magento WYSIWYG editor and can write HTML code as well as embed widgets and the like.

###Markdown

You can write your documentation using Markdown. The downside is that you cannot use widget and the like. You also
cannot use the `[[Link]]` syntax from the Magento-flavoured HTML pages but of course you can use the `[Wiki](Wiki)`
syntax.

<a name="renaming-page"></a>Renaming a page
---
When viewing a page, click the `Rename` button in the top right corner. Choose a unique page name.
The links to the page will be renamed accordingly.

<a name="creating-page"></a>Creating a new page
---
In Magento-flavoured HTML pages, you create a new page by editing an existing page and adding a documentation link in
this format:

    [[My new page]]

For Markdown pages, use this syntax:

    [Link Text](My new page)

After saving, you will see a link to the page `My new page`. When you click on it you will be told
that there is no content for this page yet. Edit the new page to fill it with content.

<a name="orphan-pages"></a>Orphan pages
---
It might happen that a project documentation page does exist but no other page is linking to it. The menu link
`Orphan pages` will show you these pages so you can create links to them.

Note that only project documentation pages are listed here. Module documentation orphan pages are not listed.
