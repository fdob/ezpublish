<?php
//
// Created on: <17-Apr-2002 10:34:48 bf>
//
// Copyright (C) 1999-2002 eZ systems as. All rights reserved.
//
// This source file is part of the eZ publish (tm) Open Source Content
// Management System.
//
// This file may be distributed and/or modified under the terms of the
// "GNU General Public License" version 2 as published by the Free
// Software Foundation and appearing in the file LICENSE.GPL included in
// the packaging of this file.
//
// Licencees holding valid "eZ publish professional licences" may use this
// file in accordance with the "eZ publish professional licence" Agreement
// provided with the Software.
//
// This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
// THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
// PURPOSE.
//
// The "eZ publish professional licence" is available at
// http://ez.no/home/licences/professional/. For pricing of this licence
// please contact us via e-mail to licence@ez.no. Further contact
// information is available at http://ez.no/home/contact/.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Contact licence@ez.no if any conditions of this licencing isn't clear to
// you.
//

include_once( 'kernel/classes/ezcontentclass.php' );
include_once( 'kernel/classes/ezcontentclassattribute.php' );

include_once( 'kernel/classes/ezcontentobject.php' );
include_once( 'kernel/classes/ezcontentobjectversion.php' );
include_once( 'kernel/classes/ezcontentobjectattribute.php' );
include_once( 'kernel/classes/ezcontentobjecttreenode.php' );

include_once( 'lib/ezutils/classes/ezhttptool.php' );

include_once( 'kernel/common/template.php' );

function checkNodeAssignments( &$module, &$class, &$object, &$version, &$contentObjectAttributes )
{
    $http =& eZHTTPTool::instance();
    $ObjectID = $object->attribute( 'id' );
    // Assign to nodes
    if ( $module->isCurrentAction( 'AddNodeAssignment' ) )
    {
        $selectedNodeIDArray = $http->postVariable( 'SelectedNodeIDArray' );

        foreach ( $selectedNodeIDArray as $nodeID )
        {
            $node = eZContentObjectTreeNode::fetch( $nodeID );
            $node->addChild( $ObjectID );
        }
    }
}

function storeNodeAssignments( &$module, &$class, &$object, &$version, &$contentObjectAttributes )
{
    $http =& eZHTTPTool::instance();
    $mainNodeID = $http->postVariable( 'MainNodeID' );

    $nodesID = array();
    if ( $http->hasPostVariable( 'NodesID' ) )
        $nodesID = $http->postVariable( 'NodesID' );

    $nodeID = eZContentObjectTreeNode::findNode( $mainNodeID, $object->attribute('id') );
    eZDebug::writeNotice( $nodeID, 'nodeID' );
    $object->setAttribute( 'main_node_id', $nodeID );
//         $object->store();

    $node = eZContentObjectTreeNode::fetch( $nodeID );
    $node->setAttribute( 'path_identification_string', $node->pathWithNames() );
    $node->setAttribute( 'crc32_path', crc32 ( $node->attribute( 'path_identification_string' ) ) );
    eZDebug::writeNotice( $node->attribute( 'path_identification_string' ), 'path_identification_string' );
    eZDebug::writeNotice( $node->attribute( 'crc32_path' ), 'CRC32' );

    $node->store();
}

function checkNodeActions( &$module, &$class, &$object, &$version, &$contentObjectAttributes, $editVersion )
{
    $http =& eZHTTPTool::instance();
    if ( $module->isCurrentAction( 'BrowseForNodes' ) )
    {
        $objectID = $object->attribute( 'id' );
//         $http->setSessionVariable( 'BrowseFromPage', "/content/edit/$objectID/$editVersion/" );
        $http->setSessionVariable( 'BrowseFromPage', $module->redirectionURI( 'content', 'edit', array( $objectID, $editVersion ) ) );
        $http->setSessionVariable( 'BrowseActionName', 'AddNodeAssignment' );
        $http->setSessionVariable( 'BrowseReturnType', 'NodeID' );

        $node = eZContentObjectTreeNode::fetch( $object->attribute( 'main_node_id' ) );
        $nodePath =  $node->attribute( 'path' );
        $rootNodeForObject = $nodePath[0];
        $nodeID = $rootNodeForObject->attribute( 'node_id' );
        $module->redirectToView( 'browse', array( $nodeID, $objectID, $editVersion ) );
        return EZ_MODULE_HOOK_STATUS_CANCEL_RUN;
    }

    if ( $module->isCurrentAction( 'DeleteNode' ) )
    {
        if ( $http->hasPostVariable( 'DeleteParentIDArray' ) )
        {
            $nodesID = $http->postVariable( 'DeleteParentIDArray' );
        }
        else
        {
            $nodesID = array();
        }
        $mainNodeID = $http->postVariable( 'MainNodeID' );
        foreach ( $nodesID as $node )
        {
            if ( $node != $mainNodeID )
            {
                eZContentObjectTreeNode::deleteNodeWhereParent( $node, $objectID );
            }
        }

    }
}

function handleNodeTemplate( &$module, &$class, &$object, &$version, &$contentObjectAttributes, $editVersion, &$tpl )
{
//$nodes =& eZContentObjectTreeNode::fetchList( true, $object->attribute( 'id' ) );
    $assignedNodeArray =& $object->parentNodes( );
    $mainParentNodeID = $object->attribute( 'main_parent_node_id' );

    $tpl->setVariable( 'assigned_node_array', $assignedNodeArray );
    $tpl->setVariable( 'main_node_id', $mainParentNodeID );
}

function initializeNodeEdit( &$module )
{
    $module->addHook( 'post_fetch', 'checkNodeAssignments' );
    $module->addHook( 'pre_commit', 'storeNodeAssignments' );
    $module->addHook( 'action_check', 'checkNodeActions' );
    $module->addHook( 'pre_template', 'handleNodeTemplate' );
}

?>
