@extends('layouts.loggedInBase')

@section('title', 'トップ')

@section('main')
    @if ($characters->isEmpty())
        {{-- キャラクターを作成してチャットをはじめよう！ --}}
    @elseif ($chatrooms->isEmpty())
        {{-- ルームを作成してチャットをはじめよう！ --}}
    @else
        <div class="inner-main">
            <section class="rooms">
                @foreach ($chatrooms as $chatroom)
                    <a href="{{ url("/chatroom/{ $chatroom->getId() }/chat") }}" class="room">
                        <p class="room-title">{{ $chatroom->getName() }} さんとのチャットルーム</p>
                        <p class="room-purpose">{{ $chatroom->getPurpoes() }}</p>
                    </a>
                @endforeach
            </section>

            <div class="hr"></div>

            @if (isset($chatroomId))
                <section class="chat-container">
                    <ul class="chat-messages">
                        @foreach ($chats as $chat)
                            @if ($chat->getRole() == 'system')
                                @continue
                            @endif

                            @if ($chat->getRole() == "user")
                                <li class="chat-message me">
                                    <img class="chat-message-icon me" src="user1.jpg">
                                    <p class="chat-message-text me">text text text</p>
                                </li>
                            @else
                                <li class="chat-message others">
                                    <img class="chat-message-icon others" src="user2.jpg">
                                    <p class="chat-message-text others">text text text</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <form action="{{ url()->current() }}" method="post" class="chat-form">
                        <textarea class="chat-form-textarea" name="text" rows="3" cols="40" placeholder="チャットを入力してください"></textarea>
                        <button class="chat-form-submit-button">
                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_9_58)">
                                <path d="M1.50624 16.2625C0.0937445 17.0687 0.224995 19.2187 1.73124 19.8437L10.5 23.5V29.9562C10.5 31.0875 11.4125 32 12.5437 32C13.15 32 13.725 31.7312 14.1125 31.2625L17.9875 26.6187L25.7312 29.8437C26.9125 30.3375 28.2812 29.5625 28.475 28.3L32.475 2.29999C32.5937 1.54374 32.2625 0.781245 31.6312 0.349995C31 -0.0812552 30.175 -0.118755 29.5062 0.262495L1.50624 16.2625ZM4.76249 17.8562L26.1062 5.66249L12.3812 21L12.4562 21.0625L4.76249 17.8562ZM25.7062 26.5875L15.2937 22.2437L28.675 7.28749L25.7062 26.5875Z" fill="white"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_9_58">
                                <rect width="32" height="32" fill="white" transform="translate(0.5)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </form>
                </section>
            @else
                {{-- さあ、ちゃっとを始めよう！ --}}
            @endif
        </div>
    @endif
@endsection
