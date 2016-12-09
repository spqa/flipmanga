<?php

use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Genre::create([
            'slug'=>str_slug('Action'),
            'name'=>'Action',
            'description'=>'A work typically depicting fighting, violence, chaos, and fast paced motion.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Mystery'),
            'name'=>'Mystery',
            'description'=>'Usually an unexplained event occurs, and the main protagonist attempts to find out what caused it.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Adult'),
            'name'=>'Adult',
            'description'=>'Contains content that is suitable only for adults. Titles in this category may include prolonged scenes of intense violence and/or graphic sexual content and nudity.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Psychological'),
            'name'=>'Psychological',
            'description'=>'Usually deals with the philosophy of a state of mind, in most cases detailing abnormal psychology.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Adventure'),
            'name'=>'Adventure',
            'description'=>'If a character in the story goes on a trip or along that line, your best bet is that it is an adventure manga. Otherwise, it\'s up to your personal prejudice on this case.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Romance'),
            'name'=>'Romance',
            'description'=>'Any love related story. We will define love as between man and woman in this case. Other than that, it is up to your own imagination of what love is',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Comedy'),
            'name'=>'Comedy',
            'description'=>'A dramatic work that is light and often humorous or satirical in tone and that usually contains a happy resolution of the thematic conflict.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('School Life'),
            'name'=>'School Life',
            'description'=>'Having a major setting of the story deal with some type of school.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Doujinshi'),
            'name'=>'Doujinshi',
            'description'=>'Fan based work inspired by official anime or manga. For MangaUpdates, original works DO NOT fall under this category',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Sci-fi'),
            'name'=>'Sci-fi',
            'description'=>'Short for science fiction, these works involve twists on technology and other science related phenomena which are contrary or stretches of the modern day scientific world.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Seinen'),
            'name'=>'Seinen',
            'description'=>'Seinen means "young Man." Manga and anime that specifically targets young adult males around the ages of 18 to 25 are seinen titles. The stories in seinen works appeal to university students and those in the working world. Typically the story lines deal with the issues of adulthood.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Drama'),
            'name'=>'Drama',
            'description'=>'A work meant to bring on an emotional response, such as instilling sadness or tension.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Ecchi'),
            'name'=>'Ecchi',
            'description'=>'Possibly the line between hentai and non-hentai, ecchi usually refers to fanservice put in to attract a certain group of fans.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Shotacon'),
            'name'=>'Shotacon',
            'description'=>'Representing a sexual attraction to young or under-age boys.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Fantasy'),
            'name'=>'Fantasy',
            'description'=>'Anything that involves, but not limited to, magic, dream world, and fairy tales.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Shoujo'),
            'name'=>'Shoujo',
            'description'=>'A work intended and primarily written for females. Usually involves a lot of romance and strong character development.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Gender Bender'),
            'name'=>'Gender Bender',
            'description'=>'Girls dressing up as guys, guys dressing up as girls.. Guys turning into girls, girls turning into guys.. I think you get the picture.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Harem'),
            'name'=>'Harem',
            'description'=>'Adult sexual content in an illustrated form where the FOCUS of the manga is placed on sexually graphic acts.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Historical'),
            'name'=>'Historical',
            'description'=>'Having to do with old or ancient times.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Shounen Ai'),
            'name'=>'Shounen Ai',
            'description'=>'Often synonymous with yaoi, this can be thought of as somewhat less extreme. "Boy\'s Love", so to speak',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Slice of Life'),
            'name'=>'Slice of Life',
            'description'=>'As the name suggests, this genre represents day-to-day tribulations of one/many character(s). These challenges/events could technically happen in real life and are often -if not all the time- set in the present timeline in a world that mirrors our own.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Smut'),
            'name'=>'Smut',
            'description'=>'Deals with series that are considered profane or offensive, particularly with regards to sexual content',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Horror'),
            'name'=>'Horror',
            'description'=>'A painful emotion of fear, dread, and abhorrence; a shuddering with terror and detestation; the feeling inspired by something frightful and shocking.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Josei'),
            'name'=>'Josei',
            'description'=>'Literally "Woman". Targets women 18-30. Female equivalent to seinen. Unlike shoujo the romance is more realistic and less idealized. The storytelling is more explicit and mature.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Sports'),
            'name'=>'Sports',
            'description'=>'As the name suggests, anything sports related. Baseball, basketball, hockey, soccer, golf, and racing just to name a few.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Lolicon'),
            'name'=>'Lolicon',
            'description'=>'Representing a sexual attraction to young or under-age girls.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Supernatural'),
            'name'=>'Supernatural',
            'description'=>'Usually entails amazing and unexplained powers or events which defy the laws of physics.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Martial Arts'),
            'name'=>'Martial Arts',
            'description'=>'As the name suggests, anything martial arts related. Any of several arts of combat or self-defense, such as aikido, karate, judo, or tae kwon do, kendo, fencing, and so on and so forth.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Tragedy'),
            'name'=>'Tragedy',
            'description'=>'Contains events resulting in great loss and misfortune.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Mature'),
            'name'=>'Mature',
            'description'=>'Contains subject matter which may be too extreme for people under the age of 17. Titles in this category may contain intense violence, blood and gore, sexual content and/or strong language.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Action'),
            'name'=>'Action',
            'description'=>'A work typically depicting fighting, violence, chaos, and fast paced motion.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Yaoi'),
            'name'=>'Yaoi',
            'description'=>'This work usually involves intimate relationships between men.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Mecha'),
            'name'=>'Mecha',
            'description'=>'Contains subject matter which may be too extreme for people under the age of 17. Titles in this category may contain intense violence, blood and gore, sexual content and/or strong language.',
            'avatar'=>''
        ]);\App\Genre::create([
            'slug'=>str_slug('Yuri'),
            'name'=>'Yuri',
            'description'=>'This work usually involves intimate relationships between women.',
            'avatar'=>''
        ]);
    }
}
