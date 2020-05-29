.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt



.. _configuration-fluidtemplating:

Fluid Templating
^^^^^^^^^^^^^^^^

The plugin "Indexed Search (Extbase & Fluid based)" can be extended with custom templates:

.. code-block:: typoscript

   plugin.tx_indexedsearch.view {
       templateRootPaths {
           0 = EXT:indexed_search/Resources/Private/Templates/
           10 = {$plugin.tx_indexedsearch.view.templateRootPath}
           20 = EXT:myextension/Resources/Private/Templates/
       }

       partialRootPaths {
           0 = EXT:indexed_search/Resources/Private/Partials/
           10 = {$plugin.tx_indexedsearch.view.partialRootPath}
           20 = EXT:myextension/Resources/Private/Partials/
       }
   }

The above configuration will make the plugin look for any template in ``myextension`` at the given relative path first and
fall back to the default ``indexed_search`` template if the configured template cannot be found.
