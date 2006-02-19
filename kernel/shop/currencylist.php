<?php
//
// Created on: <08-Nov-2005 13:06:15 dl>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ publish
// SOFTWARE RELEASE: 3.8.x
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

/*! \file currencylist.php
*/

include_once( 'kernel/common/template.php' );
include_once( 'kernel/classes/ezpreferences.php' );
include_once( 'kernel/shop/classes/ezcurrencydata.php' );
include_once( 'kernel/shop/classes/ezshopfunctions.php' );

function reloadWithOffset( &$module )
{
    $offset = $module->hasActionParameter( 'Offset' ) ? $module->actionParameter( 'Offset' ) : false;
    if ( $offset )
        $module->redirectTo( $module->functionURI( 'currencylist' ) . "/(offset)/$offset" );
}

$module =& $Params['Module'];
$offset = $Params['Offset'];

if ( $module->isCurrentAction( 'AddCurrency' ) )
{
    $module->redirectTo( $module->functionURI( 'editcurrency' ) );
}
else if ( $module->isCurrentAction( 'RemoveCurrency' ) )
{
    $currencyList = $module->hasActionParameter( 'DeleteCurrencyList' ) ? $module->actionParameter( 'DeleteCurrencyList' ) : array();

    eZShopFunctions::removeCurrency( $currencyList );

    include_once( 'kernel/classes/ezcontentcachemanager.php' );
    eZContentCacheManager::clearAllContentCache();
}
else if ( $module->isCurrentAction( 'SetRates' ) ||
          $module->isCurrentAction( 'UpdateStatus' ) )
{
    $updateDataList = $module->hasActionParameter( 'CurrencyList' ) ? $module->actionParameter( 'CurrencyList' ) : array();

    $currencyList = eZCurrencyData::fetchList();
    $db =& eZDB::instance();
    $db->begin();
    foreach ( $currencyList as $currency )
    {
        $currencyCode = $currency->attribute( 'code' );
        if ( isset( $updateDataList[$currencyCode] ) )
        {
            $updateData = $updateDataList[$currencyCode];

            if ( $module->isCurrentAction( 'UpdateStatus' ) )
            {
                if ( isset( $updateData['status'] ) )
                    $currency->setStatus( $updateData['status'] );
            }
            if ( $module->isCurrentAction( 'SetRates' ) )
            {
                if ( is_numeric( $updateData['custom_rate_value'] ) )
                    $currency->setAttribute( 'custom_rate_value', $updateData['custom_rate_value'] );
                if ( is_numeric( $updateData['rate_factor'] ) )
                    $currency->setAttribute( 'rate_factor', $updateData['rate_factor'] );
            }

            $currency->sync();
        }
    }
    $db->commit();

    reloadWithOffset( $module );
}
else if ( $module->isCurrentAction( 'UpdateAutoprices' ) )
{
    eZShopFunctions::updateAutoprices();

    include_once( 'kernel/classes/ezcontentcachemanager.php' );
    eZContentCacheManager::clearAllContentCache();

    reloadWithOffset( $module );
}


switch ( eZPreferences::value( 'currencies_list_limit' ) )
{
    case '2': { $limit = 25; } break;
    case '3': { $limit = 50; } break;
    default:  { $limit = 10; } break;
}

// fetch currencies
$currencyList = eZCurrencyData::fetchList( null, true, $offset, $limit );
$currencyCount = eZCurrencyData::fetchListCount();

$viewParameters = array( 'offset' => $offset );

$tpl =& templateInit();

$tpl->setVariable( 'currency_list', $currencyList );
$tpl->setVariable( 'currency_list_count', $currencyCount );
$tpl->setVariable( 'limit', $limit );
$tpl->setVariable( 'view_parameters', $viewParameters );

$Result = array();
$Result['path'] = array( array( 'text' => ezi18n( 'kernel/shop', 'Available currency list' ),
                                'url' => false ) );
$Result['content'] =& $tpl->fetch( "design:shop/currencylist.tpl" );



?>