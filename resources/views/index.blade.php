@extends('layouts.app')

@section('content')

    <div class="background-image grid grid-cols-1 m-auto" style="background-image: url('https://cdn.pixabay.com/photo/2021/03/23/03/25/ball-6116241_960_720.jpg');
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
        height: 600px;">

        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                    Do you want to read sports news?
                </h1>
                <a href="/blog" class="text-center bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase">
                    Read more
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img src="https://cdn.nba.com/manage/2021/01/lebron-brown-1920-210130-e1612023371826-784x429.jpg" width="700px" alt="">
        </div>
        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-3xl font-extra-bold text-gray-600">
                LeBron James explains how he’s ‘as young as I’ve ever been’ after Lakers crush Celtics
            </h2>

            <p class="py-8 text-gray-500 text-s">
                LeBron James has fended off Father Time better than just about any superstar in NBA history.
            </p>
            <p class="font-extra-bold text-gray-600 text-s pb-9">
                On Tuesday night, after the Los Angeles Lakers demolished the Boston Celtics, James divulged his secret to aging gracefully: he doesn’t think about it.
                LeBron led the Lakers (13-12) to a satisfying 117-102 victory at Staples Center.
            </p>
            <a href="/blog" class="uppercase bg-blue-500 text-gray-100 text-s font-extra-bold py-3 px-8 rounded-3xl">
                Find Out more
            </a>
        </div>
    </div>

    <div class="'text-center p-15 bg-black text-white">
        <h2 class="text-center text-2xl pb-5 text-l">
            Champions league results
        </h2>

        <span class="text-center font-extra-bold block text-4xl py-1">
            Today's results
        </span>
        <span class="text-center font-extra-bold block text-4xl py-1">
            Group standings
        </span>
        <span class="text-center font-extra-bold block text-4xl py-1">
            Stats
        </span>
        <span class="text-center font-extra-bold block text-4xl py-1">
            Clubs
        </span>
    </div>

    <div class="text-center py-15">
        <span class="uppercase text-s text-gray-400">
            Blog
        </span>
        <h2 class="text-4xl font-bold py-10">
            Recent posts
        </h2>
        <p class="m-auto w-4/5 text-gray-500">
            The New York Knicks are grasping for momentum in what has been a sophomoric campaign.
            An impressive win over the San Antonio Spurs on Tuesday night could jumpstart a string of wins.
            Knicks guard RJ Barrett had a productive night, finishing with 32 points built on a career-high seven three-pointers.
            Many expected him to make the leap this season, but that hasn’t really happened yet. In the past two weeks, he was bothered by a stomach bug.
            Barrett admitted it was difficult but he had no choice but to soldier on.
        </p>

    </div>

    <div class="sm:grid grid-cols-2 w-4/5 m-auto">
        <div class="flex bg-red-700 text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block">
                <span class="uppercase text-xs">
                    4 teams that must trade for Blazers’ Jusuf Nurkic
                </span>
                <h3 class="text-xl font-bold py-10">
                    With the Portland Trail Blazers looking to shake things up and make some roster altering moves this season,
                    one name that’s come up in recent trade rumors is Blazers center Jusuf Nurkic.

                </h3>
                <a href="" class="uppercase bg-transparent border-2 border-gray-100 text-gray-100 text-xs font-extra-bold py-3 px-5 rounded-3xl">
                    Find Out more
                </a>
            </div>
        </div>
        <div>
            <img src="https://clutchpoints.com/wp-content/uploads/2021/01/Blazers-news-Jusuf-Nurkic_s-timeline-to-return-from-wrist-injury-revealed.jpg" width="700px" alt="">
        </div>
    </div>

@endsection
