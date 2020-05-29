<?php
return array (
  'aliasToClassNameMapping' => 
  array (
    'typo3\\cms\\frontend\\view\\adminpanelview' => 'TYPO3\\CMS\\Adminpanel\\View\\AdminPanelView',
    'typo3\\cms\\frontend\\view\\adminpanelviewhookinterface' => 'TYPO3\\CMS\\Adminpanel\\View\\AdminPanelViewHookInterface',
    'typo3\\cms\\backend\\ajaxloginhandler' => 'TYPO3\\CMS\\Backend\\Controller\\AjaxLoginController',
    'typo3\\cms\\backend\\form\\wizard\\imagemanipulationwizard' => 'TYPO3\\CMS\\Backend\\Controller\\Wizard\\ImageManipulationController',
    'typo3\\cms\\cshmanual\\domain\\repository\\tablemanualrepository' => 'TYPO3\\CMS\\Backend\\Domain\\Repository\\TableManualRepository',
    'typo3\\cms\\lang\\languageservice' => 'TYPO3\\CMS\\Core\\Localization\\LanguageService',
    'typo3\\cms\\contexthelp\\controller\\contexthelpajaxcontroller' => 'TYPO3\\CMS\\Backend\\Controller\\ContextHelpAjaxController',
    'typo3\\cms\\sv\\abstractauthenticationservice' => 'TYPO3\\CMS\\Core\\Authentication\\AbstractAuthenticationService',
    'typo3\\cms\\sv\\authenticationservice' => 'TYPO3\\CMS\\Core\\Authentication\\AuthenticationService',
    'typo3\\cms\\core\\io\\pharstreamwrapper' => 'TYPO3\\PharStreamWrapper\\PharStreamWrapper',
    'typo3\\cms\\core\\io\\pharstreamwrapperexception' => 'TYPO3\\PharStreamWrapper\\Exception',
    'typo3\\cms\\core\\tree\\tableconfiguration\\extjsarraytreerenderer' => 'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\ArrayTreeRenderer',
    'typo3\\cms\\core\\history\\recordhistory' => 'TYPO3\\CMS\\Core\\DataHandling\\History\\RecordHistoryStore',
    'typo3\\cms\\saltedpasswords\\salt\\abstractsalt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\AbstractComposedSalt',
    'typo3\\cms\\saltedpasswords\\salt\\abstractcomposedsalt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\AbstractComposedSalt',
    'typo3\\cms\\saltedpasswords\\salt\\argon2isalt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
    'typo3\\cms\\saltedpasswords\\salt\\bcryptsalt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\BcryptPasswordHash',
    'typo3\\cms\\saltedpasswords\\salt\\blowfishsalt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\BlowfishPasswordHash',
    'typo3\\cms\\saltedpasswords\\salt\\composedsaltinterface' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\ComposedPasswordHashInterface',
    'typo3\\cms\\saltedpasswords\\utility\\exensionmanagerconfigurationutility' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\ExtensionManagerConfigurationUtility',
    'typo3\\cms\\saltedpasswords\\exception\\invalidsaltexception' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\InvalidPasswordHashException',
    'typo3\\cms\\saltedpasswords\\salt\\md5salt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Md5PasswordHash',
    'typo3\\cms\\saltedpasswords\\salt\\saltfactory' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\PasswordHashFactory',
    'typo3\\cms\\saltedpasswords\\salt\\saltinterface' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\PasswordHashInterface',
    'typo3\\cms\\saltedpasswords\\salt\\pbkdf2salt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Pbkdf2PasswordHash',
    'typo3\\cms\\saltedpasswords\\salt\\phpasssalt' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\PhpassPasswordHash',
    'typo3\\cms\\saltedpasswords\\saltedpasswordservice' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\SaltedPasswordService',
    'typo3\\cms\\saltedpasswords\\utility\\saltedpasswordsutility' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\SaltedPasswordsUtility',
    'typo3\\cms\\extbase\\service\\typoscriptservice' => 'TYPO3\\CMS\\Core\\TypoScript\\TypoScriptService',
    'typo3\\cms\\extbase\\configuration\\exception\\containerislockedexception' => 'TYPO3\\CMS\\Extbase\\Configuration\\Exception',
    'typo3\\cms\\extbase\\configuration\\exception\\nosuchfileexception' => 'TYPO3\\CMS\\Extbase\\Configuration\\Exception',
    'typo3\\cms\\extbase\\configuration\\exception\\nosuchoptionexception' => 'TYPO3\\CMS\\Extbase\\Configuration\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\invalidmarkerexception' => 'TYPO3\\CMS\\Extbase\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\invalidrequesttypeexception' => 'TYPO3\\CMS\\Extbase\\Mvc\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\requiredargumentmissingexception' => 'TYPO3\\CMS\\Extbase\\Mvc\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\invalidcommandidentifierexception' => 'TYPO3\\CMS\\Extbase\\Mvc\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\invalidornorequesthashexception' => 'TYPO3\\CMS\\Extbase\\Security\\Exception\\InvalidHashException',
    'typo3\\cms\\extbase\\mvc\\exception\\invaliduripatternexception' => 'TYPO3\\CMS\\Extbase\\Security\\Exception',
    'typo3\\cms\\extbase\\object\\container\\exception\\cannotinitializecacheexception' => 'TYPO3\\CMS\\Core\\Cache\\Exception\\InvalidCacheException',
    'typo3\\cms\\extbase\\object\\container\\exception\\toomanyrecursionlevelsexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\exception\\wrongscopeexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\invalidclassexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\invalidobjectconfigurationexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\invalidobjectexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\objectalreadyregisteredexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\unknownclassexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\unknowninterfaceexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\object\\unresolveddependenciesexception' => 'TYPO3\\CMS\\Extbase\\Object\\Exception',
    'typo3\\cms\\extbase\\persistence\\generic\\exception\\cleanstatenotmemorizedexception' => 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Exception',
    'typo3\\cms\\extbase\\persistence\\generic\\exception\\invalidpropertytypeexception' => 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Exception',
    'typo3\\cms\\extbase\\persistence\\generic\\exception\\missingbackendexception' => 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Exception',
    'typo3\\cms\\extbase\\property\\exception\\formatnotsupportedexception' => 'TYPO3\\CMS\\Extbase\\Property\\Exception',
    'typo3\\cms\\extbase\\property\\exception\\invalidformatexception' => 'TYPO3\\CMS\\Extbase\\Property\\Exception',
    'typo3\\cms\\extbase\\property\\exception\\invalidpropertyexception' => 'TYPO3\\CMS\\Extbase\\Property\\Exception',
    'typo3\\cms\\extbase\\reflection\\exception\\invalidpropertytypeexception' => 'TYPO3\\CMS\\Extbase\\Reflection\\Exception',
    'typo3\\cms\\extbase\\security\\exception\\invalidargumentforrequesthashgenerationexception' => 'TYPO3\\CMS\\Extbase\\Security\\Exception',
    'typo3\\cms\\extbase\\security\\exception\\syntacticallywrongrequesthashexception' => 'TYPO3\\CMS\\Extbase\\Security\\Exception',
    'typo3\\cms\\extbase\\validation\\exception\\invalidsubjectexception' => 'TYPO3\\CMS\\Extbase\\Validation\\Exception',
    'typo3\\cms\\extbase\\validation\\exception\\novalidatorfoundexception' => 'TYPO3\\CMS\\Extbase\\Validation\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\invalidviewhelperexception' => 'TYPO3\\CMS\\Extbase\\Exception',
    'typo3\\cms\\extbase\\mvc\\exception\\invalidtemplateresourceexception' => 'TYPO3Fluid\\Fluid\\View\\Exception\\InvalidTemplateResourceException',
    'typo3\\cms\\extbase\\service\\flexformservice' => 'TYPO3\\CMS\\Core\\Service\\FlexFormService',
    'typo3\\cms\\fluid\\core\\viewhelper\\abstractviewhelper' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\AbstractViewHelper',
    'typo3\\cms\\fluid\\core\\viewhelper\\abstractconditionviewhelper' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\AbstractConditionViewHelper',
    'typo3\\cms\\fluid\\core\\viewhelper\\abstracttagbasedviewhelper' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\AbstractTagBasedViewHelper',
    'typo3\\cms\\fluid\\core\\compiler\\templatecompiler' => 'TYPO3Fluid\\Fluid\\Core\\Compiler\\TemplateCompiler',
    'typo3\\cms\\fluid\\core\\parser\\interceptorinterface' => 'TYPO3Fluid\\Fluid\\Core\\Parser\\InterceptorInterface',
    'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\nodeinterface' => 'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\NodeInterface',
    'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\abstractnode' => 'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\ViewHelperNode',
    'typo3\\cms\\fluid\\core\\rendering\\renderingcontextinterface' => 'TYPO3Fluid\\Fluid\\Core\\Rendering\\RenderingContextInterface',
    'typo3\\cms\\fluid\\core\\viewhelper\\viewhelperinterface' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperInterface',
    'typo3\\cms\\fluid\\core\\viewhelper\\facets\\childnodeaccessinterface' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperInterface',
    'typo3\\cms\\fluid\\core\\viewhelper\\facets\\compilableinterface' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperInterface',
    'typo3\\cms\\fluid\\core\\viewhelper\\facets\\postparseinterface' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperInterface',
    'typo3\\cms\\fluid\\core\\exception' => 'TYPO3Fluid\\Fluid\\Core\\Exception',
    'typo3\\cms\\fluid\\core\\viewhelper\\exception' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\Exception',
    'typo3\\cms\\fluid\\core\\viewhelper\\exception\\invalidvariableexception' => 'TYPO3Fluid\\Fluid\\Core\\Exception',
    'typo3\\cms\\fluid\\view\\exception' => 'TYPO3Fluid\\Fluid\\View\\Exception',
    'typo3\\cms\\fluid\\view\\exception\\invalidsectionexception' => 'TYPO3Fluid\\Fluid\\View\\Exception\\InvalidSectionException',
    'typo3\\cms\\fluid\\view\\exception\\invalidtemplateresourceexception' => 'TYPO3Fluid\\Fluid\\View\\Exception\\InvalidTemplateResourceException',
    'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\rootnode' => 'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\RootNode',
    'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\viewhelpernode' => 'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\ViewHelperNode',
    'typo3\\cms\\fluid\\core\\viewhelper\\argumentdefinition' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ArgumentDefinition',
    'typo3\\cms\\fluid\\core\\viewhelper\\templatevariablecontainer' => 'TYPO3Fluid\\Fluid\\Core\\Variables\\StandardVariableProvider',
    'typo3\\cms\\fluid\\core\\viewhelper\\viewhelpervariablecontainer' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperVariableContainer',
    'typo3\\cms\\fluid\\core\\variables\\cmsvariableprovider' => 'TYPO3Fluid\\Fluid\\Core\\Variables\\StandardVariableProvider',
    'typo3\\cms\\fluid\\core\\viewhelper\\tagbuilder' => 'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\TagBuilder',
    'typo3\\cms\\frontend\\controller\\pageinformationcontroller' => 'TYPO3\\CMS\\Info\\Controller\\PageInformationController',
    'typo3\\cms\\frontend\\controller\\translationstatuscontroller' => 'TYPO3\\CMS\\Info\\Controller\\TranslationStatusController',
    'typo3\\cms\\infopagetsconfig\\controller\\infopagetyposcriptconfigcontroller' => 'TYPO3\\CMS\\Info\\Controller\\InfoPageTyposcriptConfigController',
    'typo3\\cms\\lowlevel\\view\\configurationview' => 'TYPO3\\CMS\\Lowlevel\\Controller\\ConfigurationController',
    'typo3\\cms\\lowlevel\\view\\databaseintegrityview' => 'TYPO3\\CMS\\Lowlevel\\Controller\\DatabaseIntegrityController',
    'typo3\\cms\\recordlist\\recordlist' => 'TYPO3\\CMS\\Recordlist\\Controller\\RecordListController',
    'typo3\\cms\\sv\\report\\serviceslistreport' => 'TYPO3\\CMS\\Reports\\Report\\ServicesListReport',
    'typo3\\cms\\t3editor\\codecompletion' => 'TYPO3\\CMS\\T3editor\\Controller\\CodeCompletionController',
    'typo3\\cms\\t3editor\\typoscriptreferenceloader' => 'TYPO3\\CMS\\T3editor\\Controller\\TypoScriptReferenceController',
    'typo3\\cms\\lowlevel\\command\\workspaceversionrecordscommand' => 'TYPO3\\CMS\\Workspaces\\Command\\WorkspaceVersionRecordsCommand',
    'typo3\\cms\\version\\datahandler\\commandmap' => 'TYPO3\\CMS\\Workspaces\\DataHandler\\CommandMap',
    'typo3\\cms\\version\\dependency\\dependencyentityfactory' => 'TYPO3\\CMS\\Workspaces\\Dependency\\DependencyEntityFactory',
    'typo3\\cms\\version\\dependency\\dependencyresolver' => 'TYPO3\\CMS\\Workspaces\\Dependency\\DependencyResolver',
    'typo3\\cms\\version\\dependency\\elemententity' => 'TYPO3\\CMS\\Workspaces\\Dependency\\ElementEntity',
    'typo3\\cms\\version\\dependency\\elemententityprocessor' => 'TYPO3\\CMS\\Workspaces\\Dependency\\ElementEntityProcessor',
    'typo3\\cms\\version\\dependency\\eventcallback' => 'TYPO3\\CMS\\Workspaces\\Dependency\\EventCallback',
    'typo3\\cms\\version\\dependency\\referenceentity' => 'TYPO3\\CMS\\Workspaces\\Dependency\\ReferenceEntity',
    'typo3\\cms\\version\\hook\\datahandlerhook' => 'TYPO3\\CMS\\Workspaces\\Hook\\DataHandlerHook',
    'typo3\\cms\\version\\hook\\previewhook' => 'TYPO3\\CMS\\Workspaces\\Preview\\PreviewUriBuilder',
    'typo3\\cms\\version\\task\\autopublishtask' => 'TYPO3\\CMS\\Workspaces\\Task\\AutoPublishTask',
    'typo3\\cms\\version\\utility\\workspacesutility' => 'TYPO3\\CMS\\Workspaces\\Service\\WorkspaceService',
  ),
  'classNameToAliasMapping' => 
  array (
    'TYPO3\\CMS\\Adminpanel\\View\\AdminPanelView' => 
    array (
      'typo3\\cms\\frontend\\view\\adminpanelview' => 'typo3\\cms\\frontend\\view\\adminpanelview',
    ),
    'TYPO3\\CMS\\Adminpanel\\View\\AdminPanelViewHookInterface' => 
    array (
      'typo3\\cms\\frontend\\view\\adminpanelviewhookinterface' => 'typo3\\cms\\frontend\\view\\adminpanelviewhookinterface',
    ),
    'TYPO3\\CMS\\Backend\\Controller\\AjaxLoginController' => 
    array (
      'typo3\\cms\\backend\\ajaxloginhandler' => 'typo3\\cms\\backend\\ajaxloginhandler',
    ),
    'TYPO3\\CMS\\Backend\\Controller\\Wizard\\ImageManipulationController' => 
    array (
      'typo3\\cms\\backend\\form\\wizard\\imagemanipulationwizard' => 'typo3\\cms\\backend\\form\\wizard\\imagemanipulationwizard',
    ),
    'TYPO3\\CMS\\Backend\\Domain\\Repository\\TableManualRepository' => 
    array (
      'typo3\\cms\\cshmanual\\domain\\repository\\tablemanualrepository' => 'typo3\\cms\\cshmanual\\domain\\repository\\tablemanualrepository',
    ),
    'TYPO3\\CMS\\Core\\Localization\\LanguageService' => 
    array (
      'typo3\\cms\\lang\\languageservice' => 'typo3\\cms\\lang\\languageservice',
    ),
    'TYPO3\\CMS\\Backend\\Controller\\ContextHelpAjaxController' => 
    array (
      'typo3\\cms\\contexthelp\\controller\\contexthelpajaxcontroller' => 'typo3\\cms\\contexthelp\\controller\\contexthelpajaxcontroller',
    ),
    'TYPO3\\CMS\\Core\\Authentication\\AbstractAuthenticationService' => 
    array (
      'typo3\\cms\\sv\\abstractauthenticationservice' => 'typo3\\cms\\sv\\abstractauthenticationservice',
    ),
    'TYPO3\\CMS\\Core\\Authentication\\AuthenticationService' => 
    array (
      'typo3\\cms\\sv\\authenticationservice' => 'typo3\\cms\\sv\\authenticationservice',
    ),
    'TYPO3\\PharStreamWrapper\\PharStreamWrapper' => 
    array (
      'typo3\\cms\\core\\io\\pharstreamwrapper' => 'typo3\\cms\\core\\io\\pharstreamwrapper',
    ),
    'TYPO3\\PharStreamWrapper\\Exception' => 
    array (
      'typo3\\cms\\core\\io\\pharstreamwrapperexception' => 'typo3\\cms\\core\\io\\pharstreamwrapperexception',
    ),
    'TYPO3\\CMS\\Core\\Tree\\TableConfiguration\\ArrayTreeRenderer' => 
    array (
      'typo3\\cms\\core\\tree\\tableconfiguration\\extjsarraytreerenderer' => 'typo3\\cms\\core\\tree\\tableconfiguration\\extjsarraytreerenderer',
    ),
    'TYPO3\\CMS\\Core\\DataHandling\\History\\RecordHistoryStore' => 
    array (
      'typo3\\cms\\core\\history\\recordhistory' => 'typo3\\cms\\core\\history\\recordhistory',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\AbstractComposedSalt' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\abstractsalt' => 'typo3\\cms\\saltedpasswords\\salt\\abstractsalt',
      'typo3\\cms\\saltedpasswords\\salt\\abstractcomposedsalt' => 'typo3\\cms\\saltedpasswords\\salt\\abstractcomposedsalt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\argon2isalt' => 'typo3\\cms\\saltedpasswords\\salt\\argon2isalt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\BcryptPasswordHash' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\bcryptsalt' => 'typo3\\cms\\saltedpasswords\\salt\\bcryptsalt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\BlowfishPasswordHash' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\blowfishsalt' => 'typo3\\cms\\saltedpasswords\\salt\\blowfishsalt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\ComposedPasswordHashInterface' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\composedsaltinterface' => 'typo3\\cms\\saltedpasswords\\salt\\composedsaltinterface',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\ExtensionManagerConfigurationUtility' => 
    array (
      'typo3\\cms\\saltedpasswords\\utility\\exensionmanagerconfigurationutility' => 'typo3\\cms\\saltedpasswords\\utility\\exensionmanagerconfigurationutility',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\InvalidPasswordHashException' => 
    array (
      'typo3\\cms\\saltedpasswords\\exception\\invalidsaltexception' => 'typo3\\cms\\saltedpasswords\\exception\\invalidsaltexception',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Md5PasswordHash' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\md5salt' => 'typo3\\cms\\saltedpasswords\\salt\\md5salt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\PasswordHashFactory' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\saltfactory' => 'typo3\\cms\\saltedpasswords\\salt\\saltfactory',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\PasswordHashInterface' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\saltinterface' => 'typo3\\cms\\saltedpasswords\\salt\\saltinterface',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Pbkdf2PasswordHash' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\pbkdf2salt' => 'typo3\\cms\\saltedpasswords\\salt\\pbkdf2salt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\PhpassPasswordHash' => 
    array (
      'typo3\\cms\\saltedpasswords\\salt\\phpasssalt' => 'typo3\\cms\\saltedpasswords\\salt\\phpasssalt',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\SaltedPasswordService' => 
    array (
      'typo3\\cms\\saltedpasswords\\saltedpasswordservice' => 'typo3\\cms\\saltedpasswords\\saltedpasswordservice',
    ),
    'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\SaltedPasswordsUtility' => 
    array (
      'typo3\\cms\\saltedpasswords\\utility\\saltedpasswordsutility' => 'typo3\\cms\\saltedpasswords\\utility\\saltedpasswordsutility',
    ),
    'TYPO3\\CMS\\Core\\TypoScript\\TypoScriptService' => 
    array (
      'typo3\\cms\\extbase\\service\\typoscriptservice' => 'typo3\\cms\\extbase\\service\\typoscriptservice',
    ),
    'TYPO3\\CMS\\Extbase\\Configuration\\Exception' => 
    array (
      'typo3\\cms\\extbase\\configuration\\exception\\containerislockedexception' => 'typo3\\cms\\extbase\\configuration\\exception\\containerislockedexception',
      'typo3\\cms\\extbase\\configuration\\exception\\nosuchfileexception' => 'typo3\\cms\\extbase\\configuration\\exception\\nosuchfileexception',
      'typo3\\cms\\extbase\\configuration\\exception\\nosuchoptionexception' => 'typo3\\cms\\extbase\\configuration\\exception\\nosuchoptionexception',
    ),
    'TYPO3\\CMS\\Extbase\\Exception' => 
    array (
      'typo3\\cms\\extbase\\mvc\\exception\\invalidmarkerexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invalidmarkerexception',
      'typo3\\cms\\extbase\\mvc\\exception\\invalidviewhelperexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invalidviewhelperexception',
    ),
    'TYPO3\\CMS\\Extbase\\Mvc\\Exception' => 
    array (
      'typo3\\cms\\extbase\\mvc\\exception\\invalidrequesttypeexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invalidrequesttypeexception',
      'typo3\\cms\\extbase\\mvc\\exception\\requiredargumentmissingexception' => 'typo3\\cms\\extbase\\mvc\\exception\\requiredargumentmissingexception',
      'typo3\\cms\\extbase\\mvc\\exception\\invalidcommandidentifierexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invalidcommandidentifierexception',
    ),
    'TYPO3\\CMS\\Extbase\\Security\\Exception\\InvalidHashException' => 
    array (
      'typo3\\cms\\extbase\\mvc\\exception\\invalidornorequesthashexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invalidornorequesthashexception',
    ),
    'TYPO3\\CMS\\Extbase\\Security\\Exception' => 
    array (
      'typo3\\cms\\extbase\\mvc\\exception\\invaliduripatternexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invaliduripatternexception',
      'typo3\\cms\\extbase\\security\\exception\\invalidargumentforrequesthashgenerationexception' => 'typo3\\cms\\extbase\\security\\exception\\invalidargumentforrequesthashgenerationexception',
      'typo3\\cms\\extbase\\security\\exception\\syntacticallywrongrequesthashexception' => 'typo3\\cms\\extbase\\security\\exception\\syntacticallywrongrequesthashexception',
    ),
    'TYPO3\\CMS\\Core\\Cache\\Exception\\InvalidCacheException' => 
    array (
      'typo3\\cms\\extbase\\object\\container\\exception\\cannotinitializecacheexception' => 'typo3\\cms\\extbase\\object\\container\\exception\\cannotinitializecacheexception',
    ),
    'TYPO3\\CMS\\Extbase\\Object\\Exception' => 
    array (
      'typo3\\cms\\extbase\\object\\container\\exception\\toomanyrecursionlevelsexception' => 'typo3\\cms\\extbase\\object\\container\\exception\\toomanyrecursionlevelsexception',
      'typo3\\cms\\extbase\\object\\exception\\wrongscopeexception' => 'typo3\\cms\\extbase\\object\\exception\\wrongscopeexception',
      'typo3\\cms\\extbase\\object\\invalidclassexception' => 'typo3\\cms\\extbase\\object\\invalidclassexception',
      'typo3\\cms\\extbase\\object\\invalidobjectconfigurationexception' => 'typo3\\cms\\extbase\\object\\invalidobjectconfigurationexception',
      'typo3\\cms\\extbase\\object\\invalidobjectexception' => 'typo3\\cms\\extbase\\object\\invalidobjectexception',
      'typo3\\cms\\extbase\\object\\objectalreadyregisteredexception' => 'typo3\\cms\\extbase\\object\\objectalreadyregisteredexception',
      'typo3\\cms\\extbase\\object\\unknownclassexception' => 'typo3\\cms\\extbase\\object\\unknownclassexception',
      'typo3\\cms\\extbase\\object\\unknowninterfaceexception' => 'typo3\\cms\\extbase\\object\\unknowninterfaceexception',
      'typo3\\cms\\extbase\\object\\unresolveddependenciesexception' => 'typo3\\cms\\extbase\\object\\unresolveddependenciesexception',
    ),
    'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Exception' => 
    array (
      'typo3\\cms\\extbase\\persistence\\generic\\exception\\cleanstatenotmemorizedexception' => 'typo3\\cms\\extbase\\persistence\\generic\\exception\\cleanstatenotmemorizedexception',
      'typo3\\cms\\extbase\\persistence\\generic\\exception\\invalidpropertytypeexception' => 'typo3\\cms\\extbase\\persistence\\generic\\exception\\invalidpropertytypeexception',
      'typo3\\cms\\extbase\\persistence\\generic\\exception\\missingbackendexception' => 'typo3\\cms\\extbase\\persistence\\generic\\exception\\missingbackendexception',
    ),
    'TYPO3\\CMS\\Extbase\\Property\\Exception' => 
    array (
      'typo3\\cms\\extbase\\property\\exception\\formatnotsupportedexception' => 'typo3\\cms\\extbase\\property\\exception\\formatnotsupportedexception',
      'typo3\\cms\\extbase\\property\\exception\\invalidformatexception' => 'typo3\\cms\\extbase\\property\\exception\\invalidformatexception',
      'typo3\\cms\\extbase\\property\\exception\\invalidpropertyexception' => 'typo3\\cms\\extbase\\property\\exception\\invalidpropertyexception',
    ),
    'TYPO3\\CMS\\Extbase\\Reflection\\Exception' => 
    array (
      'typo3\\cms\\extbase\\reflection\\exception\\invalidpropertytypeexception' => 'typo3\\cms\\extbase\\reflection\\exception\\invalidpropertytypeexception',
    ),
    'TYPO3\\CMS\\Extbase\\Validation\\Exception' => 
    array (
      'typo3\\cms\\extbase\\validation\\exception\\invalidsubjectexception' => 'typo3\\cms\\extbase\\validation\\exception\\invalidsubjectexception',
      'typo3\\cms\\extbase\\validation\\exception\\novalidatorfoundexception' => 'typo3\\cms\\extbase\\validation\\exception\\novalidatorfoundexception',
    ),
    'TYPO3Fluid\\Fluid\\View\\Exception\\InvalidTemplateResourceException' => 
    array (
      'typo3\\cms\\extbase\\mvc\\exception\\invalidtemplateresourceexception' => 'typo3\\cms\\extbase\\mvc\\exception\\invalidtemplateresourceexception',
      'typo3\\cms\\fluid\\view\\exception\\invalidtemplateresourceexception' => 'typo3\\cms\\fluid\\view\\exception\\invalidtemplateresourceexception',
    ),
    'TYPO3\\CMS\\Core\\Service\\FlexFormService' => 
    array (
      'typo3\\cms\\extbase\\service\\flexformservice' => 'typo3\\cms\\extbase\\service\\flexformservice',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\AbstractViewHelper' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\abstractviewhelper' => 'typo3\\cms\\fluid\\core\\viewhelper\\abstractviewhelper',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\AbstractConditionViewHelper' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\abstractconditionviewhelper' => 'typo3\\cms\\fluid\\core\\viewhelper\\abstractconditionviewhelper',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\AbstractTagBasedViewHelper' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\abstracttagbasedviewhelper' => 'typo3\\cms\\fluid\\core\\viewhelper\\abstracttagbasedviewhelper',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Compiler\\TemplateCompiler' => 
    array (
      'typo3\\cms\\fluid\\core\\compiler\\templatecompiler' => 'typo3\\cms\\fluid\\core\\compiler\\templatecompiler',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Parser\\InterceptorInterface' => 
    array (
      'typo3\\cms\\fluid\\core\\parser\\interceptorinterface' => 'typo3\\cms\\fluid\\core\\parser\\interceptorinterface',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\NodeInterface' => 
    array (
      'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\nodeinterface' => 'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\nodeinterface',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\ViewHelperNode' => 
    array (
      'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\abstractnode' => 'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\abstractnode',
      'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\viewhelpernode' => 'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\viewhelpernode',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Rendering\\RenderingContextInterface' => 
    array (
      'typo3\\cms\\fluid\\core\\rendering\\renderingcontextinterface' => 'typo3\\cms\\fluid\\core\\rendering\\renderingcontextinterface',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperInterface' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\viewhelperinterface' => 'typo3\\cms\\fluid\\core\\viewhelper\\viewhelperinterface',
      'typo3\\cms\\fluid\\core\\viewhelper\\facets\\childnodeaccessinterface' => 'typo3\\cms\\fluid\\core\\viewhelper\\facets\\childnodeaccessinterface',
      'typo3\\cms\\fluid\\core\\viewhelper\\facets\\compilableinterface' => 'typo3\\cms\\fluid\\core\\viewhelper\\facets\\compilableinterface',
      'typo3\\cms\\fluid\\core\\viewhelper\\facets\\postparseinterface' => 'typo3\\cms\\fluid\\core\\viewhelper\\facets\\postparseinterface',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Exception' => 
    array (
      'typo3\\cms\\fluid\\core\\exception' => 'typo3\\cms\\fluid\\core\\exception',
      'typo3\\cms\\fluid\\core\\viewhelper\\exception\\invalidvariableexception' => 'typo3\\cms\\fluid\\core\\viewhelper\\exception\\invalidvariableexception',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\Exception' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\exception' => 'typo3\\cms\\fluid\\core\\viewhelper\\exception',
    ),
    'TYPO3Fluid\\Fluid\\View\\Exception' => 
    array (
      'typo3\\cms\\fluid\\view\\exception' => 'typo3\\cms\\fluid\\view\\exception',
    ),
    'TYPO3Fluid\\Fluid\\View\\Exception\\InvalidSectionException' => 
    array (
      'typo3\\cms\\fluid\\view\\exception\\invalidsectionexception' => 'typo3\\cms\\fluid\\view\\exception\\invalidsectionexception',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Parser\\SyntaxTree\\RootNode' => 
    array (
      'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\rootnode' => 'typo3\\cms\\fluid\\core\\parser\\syntaxtree\\rootnode',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ArgumentDefinition' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\argumentdefinition' => 'typo3\\cms\\fluid\\core\\viewhelper\\argumentdefinition',
    ),
    'TYPO3Fluid\\Fluid\\Core\\Variables\\StandardVariableProvider' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\templatevariablecontainer' => 'typo3\\cms\\fluid\\core\\viewhelper\\templatevariablecontainer',
      'typo3\\cms\\fluid\\core\\variables\\cmsvariableprovider' => 'typo3\\cms\\fluid\\core\\variables\\cmsvariableprovider',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\ViewHelperVariableContainer' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\viewhelpervariablecontainer' => 'typo3\\cms\\fluid\\core\\viewhelper\\viewhelpervariablecontainer',
    ),
    'TYPO3Fluid\\Fluid\\Core\\ViewHelper\\TagBuilder' => 
    array (
      'typo3\\cms\\fluid\\core\\viewhelper\\tagbuilder' => 'typo3\\cms\\fluid\\core\\viewhelper\\tagbuilder',
    ),
    'TYPO3\\CMS\\Info\\Controller\\PageInformationController' => 
    array (
      'typo3\\cms\\frontend\\controller\\pageinformationcontroller' => 'typo3\\cms\\frontend\\controller\\pageinformationcontroller',
    ),
    'TYPO3\\CMS\\Info\\Controller\\TranslationStatusController' => 
    array (
      'typo3\\cms\\frontend\\controller\\translationstatuscontroller' => 'typo3\\cms\\frontend\\controller\\translationstatuscontroller',
    ),
    'TYPO3\\CMS\\Info\\Controller\\InfoPageTyposcriptConfigController' => 
    array (
      'typo3\\cms\\infopagetsconfig\\controller\\infopagetyposcriptconfigcontroller' => 'typo3\\cms\\infopagetsconfig\\controller\\infopagetyposcriptconfigcontroller',
    ),
    'TYPO3\\CMS\\Lowlevel\\Controller\\ConfigurationController' => 
    array (
      'typo3\\cms\\lowlevel\\view\\configurationview' => 'typo3\\cms\\lowlevel\\view\\configurationview',
    ),
    'TYPO3\\CMS\\Lowlevel\\Controller\\DatabaseIntegrityController' => 
    array (
      'typo3\\cms\\lowlevel\\view\\databaseintegrityview' => 'typo3\\cms\\lowlevel\\view\\databaseintegrityview',
    ),
    'TYPO3\\CMS\\Recordlist\\Controller\\RecordListController' => 
    array (
      'typo3\\cms\\recordlist\\recordlist' => 'typo3\\cms\\recordlist\\recordlist',
    ),
    'TYPO3\\CMS\\Reports\\Report\\ServicesListReport' => 
    array (
      'typo3\\cms\\sv\\report\\serviceslistreport' => 'typo3\\cms\\sv\\report\\serviceslistreport',
    ),
    'TYPO3\\CMS\\T3editor\\Controller\\CodeCompletionController' => 
    array (
      'typo3\\cms\\t3editor\\codecompletion' => 'typo3\\cms\\t3editor\\codecompletion',
    ),
    'TYPO3\\CMS\\T3editor\\Controller\\TypoScriptReferenceController' => 
    array (
      'typo3\\cms\\t3editor\\typoscriptreferenceloader' => 'typo3\\cms\\t3editor\\typoscriptreferenceloader',
    ),
    'TYPO3\\CMS\\Workspaces\\Command\\WorkspaceVersionRecordsCommand' => 
    array (
      'typo3\\cms\\lowlevel\\command\\workspaceversionrecordscommand' => 'typo3\\cms\\lowlevel\\command\\workspaceversionrecordscommand',
    ),
    'TYPO3\\CMS\\Workspaces\\DataHandler\\CommandMap' => 
    array (
      'typo3\\cms\\version\\datahandler\\commandmap' => 'typo3\\cms\\version\\datahandler\\commandmap',
    ),
    'TYPO3\\CMS\\Workspaces\\Dependency\\DependencyEntityFactory' => 
    array (
      'typo3\\cms\\version\\dependency\\dependencyentityfactory' => 'typo3\\cms\\version\\dependency\\dependencyentityfactory',
    ),
    'TYPO3\\CMS\\Workspaces\\Dependency\\DependencyResolver' => 
    array (
      'typo3\\cms\\version\\dependency\\dependencyresolver' => 'typo3\\cms\\version\\dependency\\dependencyresolver',
    ),
    'TYPO3\\CMS\\Workspaces\\Dependency\\ElementEntity' => 
    array (
      'typo3\\cms\\version\\dependency\\elemententity' => 'typo3\\cms\\version\\dependency\\elemententity',
    ),
    'TYPO3\\CMS\\Workspaces\\Dependency\\ElementEntityProcessor' => 
    array (
      'typo3\\cms\\version\\dependency\\elemententityprocessor' => 'typo3\\cms\\version\\dependency\\elemententityprocessor',
    ),
    'TYPO3\\CMS\\Workspaces\\Dependency\\EventCallback' => 
    array (
      'typo3\\cms\\version\\dependency\\eventcallback' => 'typo3\\cms\\version\\dependency\\eventcallback',
    ),
    'TYPO3\\CMS\\Workspaces\\Dependency\\ReferenceEntity' => 
    array (
      'typo3\\cms\\version\\dependency\\referenceentity' => 'typo3\\cms\\version\\dependency\\referenceentity',
    ),
    'TYPO3\\CMS\\Workspaces\\Hook\\DataHandlerHook' => 
    array (
      'typo3\\cms\\version\\hook\\datahandlerhook' => 'typo3\\cms\\version\\hook\\datahandlerhook',
    ),
    'TYPO3\\CMS\\Workspaces\\Preview\\PreviewUriBuilder' => 
    array (
      'typo3\\cms\\version\\hook\\previewhook' => 'typo3\\cms\\version\\hook\\previewhook',
    ),
    'TYPO3\\CMS\\Workspaces\\Task\\AutoPublishTask' => 
    array (
      'typo3\\cms\\version\\task\\autopublishtask' => 'typo3\\cms\\version\\task\\autopublishtask',
    ),
    'TYPO3\\CMS\\Workspaces\\Service\\WorkspaceService' => 
    array (
      'typo3\\cms\\version\\utility\\workspacesutility' => 'typo3\\cms\\version\\utility\\workspacesutility',
    ),
  ),
);