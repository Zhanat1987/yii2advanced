<?php

use yii\db\Schema;

class m140329_143640_insert_in_caching extends \yii\db\Migration
{
    public function up()
    {
        $table = 'caching';
        $columns = ['title', 'content'];
        $rows = [];
        $lipsum = <<<LIPSUM
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vulputate turpis diam, sit amet auctor augue feugiat tempus. Suspendisse id pharetra lorem. Donec malesuada nisl eu lobortis pharetra. Donec non magna pretium nisl bibendum cursus suscipit a purus. Curabitur vehicula magna placerat porttitor lacinia. Integer ut arcu tortor. Etiam sed vestibulum justo. Donec suscipit ipsum nulla, eget sollicitudin magna euismod et. Nulla ut vestibulum felis. Sed eu justo nec odio accumsan lacinia porta quis neque. Maecenas tempor massa magna.
Proin id quam vehicula, interdum ante quis, cursus nulla. Morbi consectetur sapien elit, at lobortis arcu lobortis eu. Etiam ultricies dignissim nisl, id suscipit tellus pellentesque et. Donec laoreet, erat sit amet semper mollis, felis orci pretium erat, et lobortis leo nibh in felis. Praesent scelerisque sem ac neque vestibulum sodales. Vivamus placerat nulla diam, sed blandit eros sollicitudin lobortis. Suspendisse aliquet tincidunt blandit. Ut suscipit tincidunt eros. Cras fringilla quis velit sit amet semper. Vestibulum porttitor tellus tincidunt malesuada porta. Curabitur pretium risus rutrum ultricies vulputate. Sed eget tristique est. In rutrum lacus in mi dignissim, vitae placerat sem egestas. Sed ac nisi elementum massa lobortis lobortis sit amet a quam. In fringilla ac orci non dignissim. Mauris rhoncus condimentum ligula quis egestas.
Nam vestibulum eget augue at dignissim. Phasellus justo dolor, tincidunt id auctor sed, ultricies eget orci. Praesent mattis tellus ornare augue fermentum facilisis. Fusce vel leo at mauris euismod sollicitudin. Aliquam erat volutpat. Ut molestie dui vitae gravida viverra. Maecenas ac metus eget est pretium congue eu quis quam.
Integer porttitor magna eget ipsum accumsan, eget faucibus nulla vulputate. Nullam aliquet nisl sit amet elit tristique iaculis. Sed interdum eleifend vestibulum. Sed quis felis cursus, malesuada urna a, tempus mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque adipiscing ornare ipsum, nec rutrum quam semper vel. Integer gravida neque eu neque dapibus suscipit. Aenean purus elit, porta sagittis vehicula non, euismod nec eros. Quisque massa urna, suscipit eget nisl in, laoreet gravida felis. Proin vel ultrices leo. Donec lobortis, purus a blandit dictum, enim nisi sagittis orci, at condimentum orci erat non sapien. Curabitur viverra tincidunt pulvinar. Donec mollis neque nulla, nec bibendum nulla laoreet ac. Donec bibendum metus eu quam eleifend mattis. Aliquam erat volutpat. Aliquam eleifend volutpat massa, elementum feugiat mauris.
Pellentesque elementum, dolor volutpat porta mattis, tortor massa blandit nunc, nec rutrum lacus enim et nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ultricies cursus justo in laoreet. Vivamus nec consequat lectus. Quisque molestie quam libero, in iaculis enim porta vitae. Donec non gravida turpis, in tincidunt eros. Proin et tristique nulla. Nullam placerat pharetra semper. Sed ornare odio vitae sagittis tempor. Suspendisse convallis mauris nunc, a varius augue commodo eget. Duis vitae feugiat purus. Phasellus ultricies tempor pretium. Pellentesque vel ante aliquet nisl lobortis eleifend sit amet sed ipsum. Ut ultrices faucibus egestas. Pellentesque a enim at nisl sodales congue at cursus ligula.
LIPSUM;
        for ($i = 1; $i <= 1000; ++$i) {
            $rows[] = ['Заголовок № ' . $i, $lipsum];
        }
        $this->batchInsert($table, $columns, $rows);
    }

    public function down()
    {
        $this->truncateTable('caching');
    }
}
