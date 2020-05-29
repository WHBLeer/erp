
module.tx_slug {
    view {
        # cat=module.tx_slug/file; type=string; label=Path to template root (BE)
        templateRootPath = EXT:slug/Resources/Private/Backend/Templates/
        # cat=module.tx_slug/file; type=string; label=Path to template partials (BE)
        partialRootPath = EXT:slug/Resources/Private/Backend/Partials/
        # cat=module.tx_slug/file; type=string; label=Path to template layouts (BE)
        layoutRootPath = EXT:slug/Resources/Private/Backend/Layouts/
    }
    persistence {
        # cat=module.tx_slug//a; type=string; label=Default storage PID
        storagePid = 0
    }
}
