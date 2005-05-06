{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{let class_content=$attribute.class_content
     class_list=fetch( class, list, hash( class_filter, $class_content.class_constraint_list ) )
     can_create=true()
     new_object_initial_node_placement=false()
     browse_object_start_node=false()}


{include uri='design:content/datatype/edit/ezobjectrelationlist_controls.tpl'}

{section show=$attribute.content.relation_list}
<table class="list" cellspacing="0">
<tr>
    <th class="tight">&nbsp;</th>
    <th class="wide">{'Name'|i18n( 'design/standard/content/datatype' )}</th>
    <th class="tight">{'Type'|i18n( 'design/standard/content/datatype' )}</th>
    <th class="tight">{'Section'|i18n( 'design/standard/content/datatype' )}</th>
    <th class="tight">{'Order'|i18n( 'design/standard/content/datatype' )}</th>
</tr>

{section var=Objects loop=$attribute.content.relation_list sequence=array( bglight, bgdark )}

{let object=fetch( content, object, hash( object_id, $Objects.item.contentobject_id, object_version, $Objects.item.contentobject_version ) )}

<tr class="{$Objects.sequence}">

{* Remove. *}
<td><input type="checkbox" name="{$attribute_base}_selection[{$attribute.id}][]" value="{$Objects.item.contentobject_id}" /></td>

<td>{$object.name|wash()}</td>

{* Class. *}
<td>{$object.class_name|wash()}</td>

{* Section. *}
<td>{fetch( section, object, hash( section_id, $object.section_id ) ).name|wash()}</td>

{* Order. *}
<td><input size="2" type="text" name="{$attribute_base}_priority[{$attribute.id}][]" value="{$Objects.item.priority}" /></td>

</tr>
{/let}
{/section}
</table>

{section-else}
<p>{'There are no related objects.'|i18n( 'design/standard/content/datatype' )}</p>
{/section}

{section show=$attribute.content.relation_list}
<input class="button" type="submit" name="CustomActionButton[{$attribute.id}_remove_objects]" value="{'Remove selected'|i18n( 'design/standard/content/datatype' )}" />&nbsp;
{*<input class="button" type="submit" name="CustomActionButton[{$attribute.id}_edit_objects]" value="{'Edit selected'|i18n( 'design/standard/content/datatype' )}" />*}
{section-else}
<input class="button-disabled" type="submit" name="CustomActionButton[{$attribute.id}_remove_objects]" value="{'Remove selected'|i18n( 'design/standard/content/datatype' )}" disabled="disabled" />&nbsp;
{*<input class="button-disabled" type="submit" name="CustomActionButton[{$attribute.id}_edit_objects]" value="{'Edit selected'|i18n( 'design/standard/content/datatype' )}" disabled="disabled" />*}
{/section}




{section show=array( 0, 2 )|contains( $class_content.type )}
    <input class="button" type="submit" name="CustomActionButton[{$attribute.id}_browse_objects]" value="{'Add existing objects'|i18n( 'design/standard/content/datatype' )}" />

    {section show=$browse_object_start_node}
        <input type="hidden" name="{$attribute_base}_browse_for_object_start_node[{$attribute.id}]" value="{$browse_object_start_node|wash}" />
    {/section}

{section-else}
    <input class="button-disabled" type="submit" name="CustomActionButton[{$attribute.id}_browse_objects]" value="{'Add existing objects'|i18n( 'design/standard/content/datatype' )}" disabled="disabled" />
{/section}

{section show=and( $can_create, array( 0, 1 )|contains( $class_content.type ) )}
{*<select class="combobox" name="{$attribute_base}_new_class[{$attribute.id}]">*}
{section name=Class loop=$class_list}
{*<option value="{$:item.id}">{$:item.name|wash}</option>*}
{/section}
{*</select>*}
{section show=$new_object_initial_node_placement}
{*<input type="hidden" name="{$attribute_base}_object_initial_node_placement[{$attribute.id}]" value="{$new_object_initial_node_placement|wash}" />*}
{/section}
{*<input class="button" type="submit" name="CustomActionButton[{$attribute.id}_new_class]" value="{'Create new object'|i18n( 'design/standard/content/datatype' )}" />*}
{/section}

{/let}
