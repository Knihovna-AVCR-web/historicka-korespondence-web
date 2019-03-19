<?php

/*
Template Name: Blekastad DB
*/

get_header();


?>

<?php get_header(); ?>

<?php while (have_posts()) : ?>
    <?php
    
    the_post();
    
    ?>
    <h1 class="my-5 mx-3">
        <?php the_title(); ?>
    </h1>
    
    <div class="row main-content mb-5" id="letters">
        
        <div class="col-md-3">
            <router-link to="/" :class="'router-link-active text-primary h3 d-block mb-3'" v-if="['letter'].indexOf($route.name) > -1">
            Zpět k vyhledávání
        </router-link>
        
        <div class="filters" v-if="['home'].indexOf($route.name) > -1">
            <div class="filter pb-3">
                <p class="filter-title mb-2"><?php _e('Autor', 'hiko'); ?></p>
                <ul class="list-unstyled filter-list">
                    <li v-for="author in getAuthours" :key="author[0]" @click="toggleFilter('author', author[0]);" :class="{ active : filter.author == author[0]}"> {{ author[0] }} ({{ author[1] }}) </li>
                </ul>
            </div>
            
            <div class="filter pb-3">
                <p class="filter-title mb-2"><?php _e('Příjemce', 'hiko'); ?></p>
                <ul class="list-unstyled filter-list">
                    <li v-for="recipient in getRecipients" :key="recipient[0]" @click="toggleFilter('recipient', recipient[0]);" :class="{ active : filter.recipient == recipient[0]}"> {{ recipient[0] }} ({{ recipient[1] }}) </li>
                </ul>
            </div>
            
            <div class="filter pb-3">
                <p class="filter-title mb-2"><?php _e('Počáteční místo', 'hiko'); ?></p>
                <ul class="list-unstyled filter-list">                
                    <li v-for="origin in getOrigins" :key="origin[0]" @click="toggleFilter('origin', origin[0]);" :class="{ active : filter.origin == origin[0]}"> {{ origin[0] }} ({{ origin[1] }}) </li>
                </ul>
            </div>
            
            <div class="filter pb-3">
                <p class="filter-title mb-2"><?php _e('Místo určení', 'hiko'); ?></p>
                <ul class="list-unstyled filter-list">
                    <li v-for="dest in getDests" :key="dest[0]" @click="toggleFilter('dest', dest[0]);" :class="{ active : dest.origin == dest[0]}"> {{ dest[0] }} ({{ dest[1] }}) </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="loading mb-5" v-if="loading && ['home'].indexOf($route.name) > -1">
            <?php _e('Načítám'); ?>
        </div>
        
        <div v-if="error && ['home'].indexOf($route.name) > -1" class="error alert alert-warning mb-5">
            {{ error }}
        </div>
        
        <div v-if="letterErr && ['letter'].indexOf($route.name) > -1" class="error alert alert-warning mb-5">
            {{ letterErr }}
        </div>
        
        <table class="table table-bordered table-hover table-striped filter-table" v-if="['home'].indexOf($route.name) > -1">
            <thead>
                <tr>
                    <th @click="sort = 'l_no'" :class="{ sorted: sort == 'l_no'}"><?php _e('Číslo', 'hiko'); ?></th>
                    <th @click="sort = 'date'" :class="{ sorted: sort == 'date'}"><?php _e('Datum', 'hiko'); ?></th>
                    <th @click="sort = 'author'" :class="{ sorted: sort == 'author'}"><?php _e('Autor', 'hiko'); ?></th>
                    <th @click="sort = 'recipient'" :class="{ sorted: sort == 'recipient'}"><?php _e('Příjemce', 'hiko'); ?></th>
                    <th @click="sort = 'origin'" :class="{ sorted: sort == 'origin'}"><?php _e('Počáteční místo', 'hiko'); ?></th>
                    <th @click="sort = 'dest'" :class="{ sorted: sort == 'dest'}"><?php _e('Místo určení', 'hiko'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, index) in filteredData" :key="index">
                    <td> 
                        <router-link :to="{ name: 'letter', params: { id: row.l_no, y: row.year ? row.year : '0000', m: row.month ? row.month : '00', d: row.day ? row.day : '00' }}" :class="'underlined'">{{ row.l_no }} </router-link>
                    </td>
                    <td data-date="">
                        {{ row.year + '/' + row.month + '/' + row.day }}
                    </td>
                    <td><span v-html="row.author.replace(/;/g, '<br>')"></span></td>
                    <td><span v-html="row.recipient.replace(/;/g, '<br>')"></span></td>
                    <td><span v-html="row.origin.replace(/;/g, '<br>')"></span></td>
                    <td><span v-html="row.dest.replace(/;/g, '<br>')"></span></td>
                </tr>
            </tbody>
        </table>
        
        <div class="letter-single" v-if="['letter'].indexOf($route.name) > -1 && letter && !letterErr">
            <h3>
                {{ letter.day ? letter.day : '?' }}. {{ letter.month ? letter.month : '?'}}. {{ letter.year ? letter.year : '?' }}:&#32;
                {{ letter.author ? letter.author.replace(/;/g, ', ') : '' }} {{ letter.origin ? '(' + letter.origin.replace(/;/g, ', ') + ')' : '' }}&#32;
                {{ letter.recipient ? '&rarr; ' : ''}}
                {{ letter.recipient ? letter.recipient.replace(/;/g, ', ') : '' }} {{ letter.dest ? '(' + letter.dest.replace(/;/g, ', ') + ')' : '' }}
            </h3>
            
            <div class="my-5">
                <h5><?php _e('Data', 'hiko'); ?></h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%"><?php _e('Datum dopisu', 'hiko'); ?></td>
                            <td>
                                {{ letter.day ? letter.day : '?' }}. {{ letter.month ? letter.month : '?'}}. {{ letter.year ? letter.year : '????' }} 
                                <span v-if="letter.date_uncertain">
                                    <br> 
                                    <small>(<?php _e('Nejisté datum', 'hiko'); ?>)</small>
                                </span>
                            </td>
                        </tr>
                        <tr v-if="letter.date_notes">
                            <td><?php _e('Poznámky', 'hiko'); ?></td>
                            <td>{{ letter.date_notes }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mb-5">
                <h5><?php _e('Lidé', 'hiko'); ?></h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%"><?php _e('Autor', 'hiko'); ?></td>
                            <td>
                                <span v-html="letter.author.replace(/;/g, '<br>')"></span>
                                <span v-if="letter.author_uncertain">
                                    <br> 
                                    <small>(<?php _e('Nejistý autor', 'hiko'); ?>)</small>
                                </span>
                                <span v-if="letter.author_inferred">
                                    <br> 
                                    <small>(<?php _e('Autor vyvozený z obsahu dopisu', 'hiko'); ?>)</small>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e('Příjemce', 'hiko'); ?></td>
                            <td>
                                <span v-html="letter.recipient.replace(/;/g, '<br>')"></span>
                                <span v-if="letter.recipient_uncertain">
                                    <br> 
                                    <small>(<?php _e('Nejistý příjemce', 'hiko'); ?>)</small>
                                </span>
                                <span v-if="letter.recipient_inferred">
                                    <br> 
                                    <small>(<?php _e('Příjemce vyvozený z obsahu dopisu', 'hiko'); ?>)</small>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mb-5">
                <h5><?php _e('Místa', 'hiko'); ?></h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%"><?php _e('Počáteční místo', 'hiko'); ?></td>
                            <td>
                                <span v-html="letter.origin.replace(/;/g, '<br>')"></span>
                                <span v-if="letter.origin_uncertain">
                                    <br> 
                                    <small>(<?php _e('Nejisté počáteční místo', 'hiko'); ?>)</small>
                                </span>
                                <span v-if="letter.origin_inferred">
                                    <br> 
                                    <small>(<?php _e('Počáteční místo vyvozeno z obsahu dopisu', 'hiko'); ?>)</small>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e('Místo určení', 'hiko'); ?></td>
                            <td>
                                <span v-html="letter.dest.replace(/;/g, '<br>')"></span>
                                <span v-if="letter.dest_uncertain">
                                    <br> 
                                    <small>(<?php _e('Nejisté místo určení', 'hiko'); ?>)</small>
                                </span>
                                <span v-if="letter.dest_inferred">
                                    <br> 
                                    <small>(<?php _e('Místo určení vyvozeno z obsahu dopisu', 'hiko'); ?>)</small>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mb-5">
                <h5><?php _e('Obsah', 'hiko'); ?></h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%"><?php _e('Jazyk', 'hiko'); ?></td>
                            <td><span v-html="letter.lang.replace(/;/g, ', ')"></span></td>
                        </tr>
                        <tr v-if="letter.abstract">
                            <td><?php _e('Abstrakt', 'hiko'); ?></td>
                            <td>{{ letter.abstract }}</td>
                        </tr>
                        <tr v-if="letter.incipit">
                            <td><?php _e('Incipit', 'hiko'); ?></td>
                            <td>{{ letter.incipit }}</td>
                        </tr>
                        <tr v-if="letter.explicit">
                            <td><?php _e('Explicit', 'hiko'); ?></td>
                            <td>{{ letter.explicit }}</td>
                        </tr>
                        <tr v-if="letter.keywords">
                            <td><?php _e('Klíčová slova', 'hiko'); ?></td>
                            <td>
                                <ul class="list-unstyled">
                                    <li v-for="kw in letter.keywords.split(';')">{{ kw }}</li>
                                </ul>
                            </td>
                        </tr>
                        <tr v-if="letter.people_mentioned">
                            <td><?php _e('Zmíněné osoby', 'hiko'); ?></td>
                            <td>
                                <ul class="list-unstyled">
                                    <li v-for="person in letter.people_mentioned.split(';')">{{ person }}</li>
                                </ul>
                            </td>
                        </tr>
                        <tr v-if="letter.notes_public">
                            <td><?php _e('Poznámka', 'hiko'); ?></td>
                            <td>
                                {{ letter.notes_public }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php /* ?>
            <div class="mb-5">
                <h5><?php _e('Uložení a poznámky', 'hiko'); ?></h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%"><?php _e('Data', 'hiko'); ?>Místo uložení</td>
                            <td>Filosofický ústav AV ČR</td>
                        </tr>
                        <tr>
                            <td><?php _e('Poznámky', 'hiko'); ?></td>
                            <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed convallis magna eu sem. In convallis. Nulla non arcu lacinia neque faucibus fringilla. </td>
                        </tr>
                        
                        <tr>
                            <td><?php _e('Data', 'hiko'); ?>MS manifestation?</td>
                            <td>MS Letter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-5">
                <h5><?php _e('Data', 'hiko'); ?>Propojené zdroje</h5>
                <table class="table single-table">
                    <tbody>
                        <tr>
                            <td>
                                <a href="#">
                                    Název zdroje
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php */ ?>
        </div>
    </div>
</div>


<?php endwhile;

get_footer();
