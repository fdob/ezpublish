<?php
//
// Created on: <17-Apr-2002 11:05:08 amos>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ publish
// SOFTWARE RELEASE: 3.10.x
// COPYRIGHT NOTICE: Copyright (C) 1999-2006 eZ systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

$Module = array( 'name' => 'eZContentObject',
                 'variable_params' => true );

$ViewList = array();
$ViewList['edit'] = array(
    'functions' => array( 'edit' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'ui_context' => 'edit',
    'single_post_actions' => array( 'PreviewButton' => 'Preview',
                                    'TranslateButton' => 'Translate',
                                    'VersionsButton' => 'VersionEdit',
                                    'PublishButton' => 'Publish',
                                    'DiscardButton' => 'Discard',
                                    'BrowseNodeButton' => 'BrowseForNodes',
                                    'EditLanguageButton' => 'EditLanguage',
                                    'BrowseObjectButton' => 'BrowseForObjects',
                                    'UploadFileRelationButton' => 'UploadFileRelation',
                                    'NewButton' => 'NewObject',
                                    'DeleteRelationButton' => 'DeleteRelation',
                                    'StoreButton' => 'Store',
                                    'MoveNodeID' => 'MoveNode',
                                    'RemoveNodeID' => 'DeleteNode',
                                    'ConfirmButton' => 'ConfirmAssignmentDelete'
                                    ),
    'post_action_parameters' => array( 'EditLanguage' => array( 'SelectedLanguage' => 'EditSelectedLanguage' ),
                                       'UploadFileRelation' => array( 'UploadRelationLocation' => 'UploadRelationLocationChoice' ) ),
    'post_actions' => array( 'BrowseActionName' ),
    'script' => 'edit.php',
    'params' => array( 'ObjectID', 'EditVersion', 'EditLanguage' ) );

$ViewList['removenode'] = array(
    'functions' => array( 'edit' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'ui_context' => 'edit',
    'single_post_actions' => array( 'ConfirmButton' => 'ConfirmAssignmentRemove',
                                    'CancelButton' => 'CancelAssignmentRemove' ),
    'script' => 'removenode.php',
    'params' => array( 'ObjectID', 'EditVersion', 'EditLanguage', 'NodeID' ) );

$ViewList['removelocation'] = array(
    'functions' => array( 'edit' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'ui_context' => 'edit',
    'ui_component' => 'location',
    'single_post_actions' => array( 'ConfirmRemovalButton' => 'ConfirmRemoval',
                                    'CancelRemovalButton' => 'CancelRemoval' ),
    'script' => 'removelocation.php',
    'params' => array() );

$ViewList['pdf'] = array(
    'functions' => array( 'pdf' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'pdf.php',
    'params' => array( 'NodeID' ),
    'unordered_params' => array( 'language' => 'Language',
                                 'offset' => 'Offset',
                                 'year' => 'Year',
                                 'month' => 'Month',
                                 'day' => 'Day' )
    );

$ViewList['view'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'view.php',
    'params' => array( 'ViewMode', 'NodeID' ),
    'unordered_params' => array( 'language' => 'Language',
                                 'offset' => 'Offset',
                                 'year' => 'Year',
                                 'month' => 'Month',
                                 'day' => 'Day' )
    );

$ViewList['copy'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'copy.php',
    'ui_context' => 'edit',
    'single_post_actions' => array( 'CopyButton' => 'Copy',
                                    'CancelButton' => 'Cancel' ),
    'post_action_parameters' => array( 'Copy' => array( 'VersionChoice' => 'VersionChoice' ) ),
    'post_actions' => array( 'BrowseActionName' ),
    'params' => array( 'ObjectID' ) );


$ViewList['versionview'] = array(
    'functions' => array( 'versionread' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'versionview.php',
    'single_post_actions' => array( 'ChangeSettingsButton' => 'ChangeSettings',
                                    'EditButton' => 'Edit',
                                    'VersionsButton' => 'Versions',
                                    'PreviewPublishButton' => 'Publish' ),
    'post_action_parameters' => array( 'ChangeSettings' => array( 'Language' => 'SelectedLanguage',
                                                                  'PlacementID' => 'SelectedPlacement',
                                                                  'Sitedesign' => 'SelectedSitedesign' ) ),
    'params' => array( 'ObjectID', 'EditVersion', 'LanguageCode' ),
    'unordered_params' => array( 'language' => 'Language',
                                 'offset' => 'Offset' ) );

$ViewList['search'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'search.php',
    'params' => array( ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['urltranslator'] = array(
    'functions' => array( 'urltranslator' ),
    'default_navigation_part' => 'ezsetupnavigationpart',
    'script' => 'urltranslator.php',
    'ui_context' => 'administration',
    'single_post_actions' => array( 'NewURLAliasButton' => 'NewURLAlias',
                                    'NewForwardURLAliasButton' => 'NewForwardURLAlias',
                                    'NewWildcardURLAliasButton' => 'NewWildcardURLAlias',
                                    'RemoveURLAliasButton' => 'RemoveURLAlias',
                                    'StoreURLAliasButton' => 'StoreURLAlias' ),
    'params' => array( ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['advancedsearch'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'advancedsearch.php',
    'params' => array( 'ViewMode' ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['browse'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'ui_context' => 'browse',
    'script' => 'browse.php',
    'single_post_actions' => array( 'CancelButton' => 'Cancel' ),
    'params' => array( 'NodeID', 'ObjectID', 'EditVersion' ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['upload'] = array(
    'functions' => array( 'create' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'ui_context' => 'upload',
    'script' => 'upload.php',
    'single_post_actions' => array( 'UploadFileButton' => 'UploadFile' ),
    'post_action_parameters' => array( 'UploadFile' => array( 'UploadLocation' => 'UploadLocationChoice' ) ),
    'params' => array() );

$ViewList['removeobject'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'removeobject.php',
    'ui_context' => 'edit',
    'params' => array( ) );

$ViewList['removeeditversion'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'removeeditversion.php',
    'ui_context' => 'edit',
    'params' => array( ) );

$ViewList['download'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'download.php',
    'params' => array( 'ContentObjectID', 'ContentObjectAttributeID', 'FileType' ) );

$ViewList['action'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'action.php',
    'params' => array(  ),
    'single_post_actions' => array( 'RemoveAssignmentButton' => 'RemoveAssignment',
                                    'AddAssignmentButton' => 'SelectAssignmentLocation',
                                    'AddAssignmentAction' => 'AddAssignment',
                                    'UpdateMainAssignmentButton' => 'UpdateMainAssignment',
                                    'MoveNodeButton' => 'MoveNodeRequest',
                                    'MoveNodeAction' => 'MoveNode' ),
    'post_action_parameters' => array( 'SelectAssignmentLocation' => array( 'AssignmentIDSelection' => 'AssignmentIDSelection',
                                                                            'NodeID' => 'ContentNodeID',
                                                                            'ObjectID' => 'ContentObjectID',
                                                                            'ViewMode' => 'ViewMode',
                                                                            'LanguageCode' => 'ContentObjectLanguageCode' ),
                                       'AddAssignment' => array( 'AssignmentIDSelection' => 'AssignmentIDSelection',
                                                                 'NodeID' => 'ContentNodeID',
                                                                 'ObjectID' => 'ContentObjectID',
                                                                 'ViewMode' => 'ViewMode',
                                                                 'LanguageCode' => 'ContentObjectLanguageCode' ),
                                       'RemoveAssignment' => array( 'AssignmentIDSelection' => 'AssignmentIDSelection',
                                                                    'NodeID' => 'ContentNodeID',
                                                                    'ObjectID' => 'ContentObjectID',
                                                                    'ViewMode' => 'ViewMode',
                                                                    'LanguageCode' => 'ContentObjectLanguageCode' ),
                                       'UpdateMainAssignment' => array( 'MainAssignmentID' => 'MainAssignmentCheck',
                                                                        'HasMainAssignment' => 'HasMainAssignment',
                                                                        'NodeID' => 'ContentNodeID',
                                                                        'ObjectID' => 'ContentObjectID',
                                                                        'ViewMode' => 'ViewMode',
                                                                        'LanguageCode' => 'ContentObjectLanguageCode' ),
                                       'MoveNodeRequest' => array( 'NodeID' => 'ContentNodeID',
                                                                   'ViewMode' => 'ViewMode',
                                                                   'LanguageCode' => 'ContentObjectLanguageCode' ),
                                       'MoveNode' => array( 'NodeID' => 'ContentNodeID',
                                                            'ViewMode' => 'ViewMode',
                                                            'NewParentNode' => 'NewParentNode',
                                                            'LanguageCode' => 'ContentObjectLanguageCode' ) ),
    'post_actions' => array( 'BrowseActionName' ) );

$ViewList['collectinformation'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'collectinformation.php',
    'single_post_actions' => array( 'ActionCollectInformation' => 'CollectInformation' ),
    'post_action_parameters' => array( 'CollectInformation' => array( 'ContentObjectID' => 'ContentObjectID',
                                                                      'ContentNodeID' => 'ContentNodeID',
                                                                      'ViewMode' => 'ViewMode' ) ),
    'params' => array(  ) );

$ViewList['versions'] = array(
    'functions' => array( 'read', 'edit' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'versions.php',
    'single_post_actions' => array( 'CopyVersionButton' => 'CopyVersion',
                                    'EditButton' => 'Edit' ),
    'post_action_parameters' => array( 'CopyVersion' => array( 'VersionID' => 'RevertToVersionID',
                                                               'EditLanguage' => 'EditLanguage',
                                                               'VersionKeyArray' => 'CopyVersionButton' ),
                                       'Edit' => array( 'VersionID' => 'RevertToVersionID',
                                                        'EditLanguage' => 'EditLanguage',
                                                        'VersionKeyArray' => 'EditButton' ) ),
    'params' => array( 'ObjectID' ,'EditVersion', 'EditLanguage' ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['translate'] = array(
    'functions' => array( 'translate' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'ui_context' => 'edit',
    'script' => 'translate.php',
    'single_post_actions' => array( 'EditObjectButton' => 'EditObject',
                                    'PreviewButton' => 'Preview',
                                    'StoreButton' => 'Store',
                                    'AddLanguageButton' => 'AddLanguage',
                                    'DeleteButton' => 'RemoveLanguage',
                                    'RemoveLanguageConfirmationButton' => 'RemoveLanguageConfirmation',
                                    'RemoveLanguageCancelButton' => 'RemoveLanguageCancel',
                                    'EditLanguageButton' => 'EditLanguage' ),
    'post_action_parameters' => array( 'AddLanguage' => array( 'SelectedLanguage' => 'SelectedLanguage' ) ,
                                       'RemoveLanguage' => array( 'SelectedLanguageList' => 'RemoveLanguageArray' ),
                                       'RemoveLanguageConfirmation' => array( 'SelectedLanguageList' => 'RemoveLanguageArray' ),
                                       'EditLanguage' => array( 'SelectedLanguage' => 'EditSelectedLanguage' ) ),
    'action_parameters' => array( 'CancelTask' => array( 'SelectedLanguage' ) ),
    'params' => array( 'ObjectID', 'EditVersion' ) );

$ViewList['draft'] = array(
    'functions' => array( 'create' ),
    'script' => 'draft.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['trash'] = array(
    'functions' => array( 'restore' ),
    'script' => 'trash.php',
    'default_navigation_part' => 'ezcontentnavigationpart',
    'params' => array( ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['translations'] = array(
    'functions' => array( 'translations' ),
    'ui_context' => 'administration',
    'default_navigation_part' => 'ezsetupnavigationpart',
    'script' => 'translations.php',
    'single_post_actions' => array( 'RemoveButton' => 'Remove',
                                    'StoreButton' => 'StoreNew',
                                    'NewButton' => 'New',
                                    'ConfirmButton' => 'Confirm' ),
    'post_action_parameters' => array( 'StoreNew' => array( 'LocaleID' => 'LocaleID',
                                                            'TranslationName' => 'TranslationName',
                                                            'TranslationLocale' => 'TranslationLocale' ),
                                       'Remove' => array( 'SelectedTranslationList' => 'DeleteIDArray' ),
                                       'Confirm' => array( 'ConfirmList' => 'ConfirmTranlationID' ) ),
    'params' => array( 'TranslationID' ) );

$ViewList['tipafriend'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'tipafriend.php',
    'params' => array( 'NodeID' ) );

$ViewList['keyword'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'keyword.php',
    'params' => array( 'alphabet'=>'Alphabet' ),
    'unordered_params' => array( 'offset' => 'Offset', 'classid' => 'ClassID' ) );

$ViewList['collectedinfo'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'collectedinfo.php',
    'params' => array( 'NodeID' ) );

$ViewList['bookmark'] = array(
    'functions' => array( 'bookmark' ),
    'default_navigation_part' => 'ezmynavigationpart',
    'script' => 'bookmark.php',
    'params' => array(),
    'single_post_actions' => array( 'AddButton' => 'Add',
                                    'RemoveButton' => 'Remove' ),
    'post_actions' => array( 'BrowseActionName' ),
    'post_action_parameters' => array( 'Remove' => array( 'DeleteIDArray' => 'DeleteIDArray' ) ),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['pendinglist'] = array(
    'functions' => array( 'pendinglist' ),
    'default_navigation_part' => 'ezmynavigationpart',
    'script' => 'pendinglist.php',
    'params' => array(),
    'unordered_params' => array( 'offset' => 'Offset' ) );

$ViewList['new'] = array(
    'functions' => array( 'read' ),
    'default_navigation_part' => 'ezcontentnavigationpart',
    'script' => 'newcontent.php',
    'params' => array() );

$ClassID = array(
    'name'=> 'Class',
    'values'=> array(),
    'path' => 'classes/',
    'file' => 'ezcontentclass.php',
    'class' => 'eZContentClass',
    'function' => 'fetchList',
    'parameter' => array( 0, false )
    );

$ParentClassID = array(
    'name'=> 'ParentClass',
    'values'=> array(),
    'path' => 'classes/',
    'file' => 'ezcontentclass.php',
    'class' => 'eZContentClass',
    'function' => 'fetchList',
    'parameter' => array( 0, false )
    );

$SectionID = array(
    'name'=> 'Section',
    'values'=> array(),
    'path' => 'classes/',
    'file' => 'ezsection.php',
    'class' => 'eZSection',
    'function' => 'fetchList',
    'parameter' => array(  false )
    );
$Status = array(
    'name'=> 'Status',
    'values'=> array(),
    'path' => 'classes/',
    'file' => 'ezcontentobjectversion.php',
    'class' => 'eZContentObjectVersion',
    'function' => 'statusList',
    'parameter' => array(  false )
    );
$Assigned = array(
    'name'=> 'Owner',
    'values'=> array(
        array(
            'Name' => 'Self',
            'value' => '1')
        )
    );
$Node = array(
    'name'=> 'Node',
    'values'=> array()
    );

$Subtree = array(
    'name'=> 'Subtree',
    'values'=> array()
    );

$FunctionList['bookmark'] = array();

$FunctionList['move'] = array();

$FunctionList['read'] = array( 'Class' => $ClassID,
                               'Section' => $SectionID,
                               'Owner' => $Assigned,
                               'Node' => $Node,
                               'Subtree' => $Subtree);
$FunctionList['create'] = array( 'Class' => $ClassID,
                                 'Section' => $SectionID,
                                 'ParentClass' => $ParentClassID,
                                 'Node' => $Node,
                                 'Subtree' => $Subtree
                                 );
$FunctionList['edit'] = array( 'Class' => $ClassID,
                               'Section' => $SectionID,
                               'Owner' => $Assigned,
                               'Node' => $Node,
                               'Subtree' => $Subtree);
$FunctionList['translate'] = array( 'Class' => $ClassID,
                                    'Section' => $SectionID,
                                    'Owner' => $Assigned,
                                    'Node' => $Node,
                                    'Subtree' => $Subtree );
$FunctionList['remove'] = array( 'Class' => $ClassID,
                                 'Section' => $SectionID,
                                 'Owner' => $Assigned,
                                 'Node' => $Node,
                                 'Subtree' => $Subtree
                                 );

$FunctionList['versionread'] = array( 'Class' => $ClassID,
                                      'Section' => $SectionID,
                                      'Owner' => $Assigned,
                                      'Status' => $Status,
                                      'Node' => $Node,
                                      'Subtree' => $Subtree);

$FunctionList['pdf'] = array( 'Class' => $ClassID,
                              'Section' => $SectionID,
                              'Owner' => $Assigned,
                              'Node' => $Node,
                              'Subtree' => $Subtree );

$FunctionList['translations'] = array();
$FunctionList['urltranslator'] = array();
$FunctionList['pendinglist'] = array();

$FunctionList['restore'] = array( );
$FunctionList['cleantrash'] = array( );

/*
$ViewArray['view'] = array(
    'functions' => array( 'read', ''
    'script' => 'view.php',
    'params' => array( 'ViewMode', 'NodeID', 'LanguageCode' ),
    'unordered_params' => array( 'language' => 'Language',
                                 'offset' => 'Offset' )
    );

*/
// Module definition





?>