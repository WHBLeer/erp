
# Module configuration
module.tx_slug {
    persistence {
        storagePid = {$module.tx_slug.persistence.storagePid}
    }
    view {
        templateRootPaths.0 = EXT:slug/Resources/Private/Backend/Templates/
        templateRootPaths.1 = {$module.tx_slug.view.templateRootPath}
        partialRootPaths.0 = EXT:slug/Resources/Private/Backend/Partials/
        partialRootPaths.1 = {$module.tx_slug.view.partialRootPath}
        layoutRootPaths.0 = EXT:slug/Resources/Private/Backend/Layouts/
        layoutRootPaths.1 = {$module.tx_slug.view.layoutRootPath}
    }
    settings{
        additionalTables{

            /*
            tx_news_domain_model_news{
                label = News                                                        # Label for the backend
                slugField = path_segment                                            # Database field where the slug is saved
                titleField = title                                                  # Field thats used for the title display
                pid = 1                                                             # Show only records from given PID (parent page)
                icon = EXT:news/Resources/Public/Icons/news_domain_model_news.svg   # The icon for your records. Please make sure the file exsists!
            }
            */

        }
    }
}
