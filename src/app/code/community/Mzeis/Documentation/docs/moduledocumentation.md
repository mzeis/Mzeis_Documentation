Module documentation
===

<a name="make-available"></a>Making your documentation available in the backend
---
When you first install Mzeis_Documentation you may notice that your module documentation is not available in the
backend.

*Bummer*.

Why is that?

Most likely your extension is installed using Composer, modman or a similar mechanism linking modules into the core.

If this is true or your documentation files cannot be found in `app/code/[core|community|local]/[Vendor]/[Module]/` for
another reason, Mzeis_Documentation won't find the files.

<a name="make-files-read"></a>Ways to make your files being read
---

Two possible ways to get your files read by Mzeis_Documentation:

1. Put the documentation files inside of your module code directory (e.g. `src/app/code/community/Vendor/Module/`) so
   that the files are in the directory which is symlinked into Magento.
2. Add special symlinks linking your documentation files from your Composer / modman directories into the module
   directories.
   
There may be more ways to solve this problem but these are first one which came to my mind.
   
<a name="module-documentation-database"></a>Alternative: save the module documentation in the database
---
   
Another option you can use is to maintain the module documentation in the database.

Module documentation page entries you create will not be editable in the backend and will look like a regular page
coming from a markdown file.
  
    $page = Mage::getModel('mzeis_documentation/page');
    $page->setModule('Mzeis_Documentation');
    $page->setName('Page name');
    $page->setContent('Page content');
    $page->setSource(Mzeis_Documentation_Model_Page::SOURCE_DATABASE);
    $page->setType(Mzeis_Documentation_Model_Page::TYPE_MODULE);
    $page->setFormat(Mzeis_Documentation_Model_Page::FORMAT_MARKDOWN);
    $page->save();

Updating pages is a bit of work at the moment. While there is a method `$page->loadByName()` you cannot define the
module yet so you may run into problems if there are two pages with the same name. If would be safer to find out the ID
of the page and use it to load the page.
