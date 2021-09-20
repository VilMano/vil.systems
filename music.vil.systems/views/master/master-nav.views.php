<style>
    #column-navbar{
        display: flex;
        flex-direction: column;
    }

    .btn{
        background-color: #111;
        width: 5rem;
        margin: .1rem 0 .1rem 0;
        padding: 1rem 0 1rem 0;
        cursor: pointer;
        text-align: center;
    }

    #navbar{
        margin-top: auto;
        margin-bottom: auto;
        position: fixed;
        top: 50%;
        color: rgb(226, 226, 226);
    }

    .round-top{
        border-radius: 0 15px 0 0;
    }

    .round-bottom{
        border-radius: 0 0 15px 0;
    }

    @media only screen and (max-width: 960px){
        #navbar{
            bottom: 0;
            top: auto;
            width: 100%;
        }

        #column-navbar{
            flex-direction: row;
            justify-content: center;
        }

        .btn{
            margin: 0 .1rem 0 .1rem;
        }

        .round-top{
            border-radius: 15px 0 0 0;
        }

        .round-bottom{
            border-radius: 0 15px 0 0;
        }
    }
</style>

<div id="column-navbar">
    <div id="homepage-btn" class="btn center round-top"><span onclick="redirect('home');">Home</span></div>
    <div id="music-btn" class="btn center"><span onclick="redirect('music');">Music</span></div>
    <div id="gallery-btn" class="btn center round-bottom"><span onclick="redirect('gallery');">Gallery</span></div>
    <!-- <div id="blog-btn" class="btn center"><span onclick="redirect('blog');">Blog</span></div> -->
    <!-- <div id="about-btn" class="btn center"><span onclick="redirect('about');">About</span></div> -->
</div>