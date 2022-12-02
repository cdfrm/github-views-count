# Github profile views counter
## Simple Php to get how many views are on your Github profile.

<p align="center">
<a href="https://github.com/cdfrm/github-views-count"><img src="https://img.shields.io/badge/PHP-7.4-green?style=for-the-badge" alt="Php"></a>
<a href="https://github.com/cdfrm/github-views-count"><img src="https://img.shields.io/badge/NGINX-LATEST-green?style=for-the-badge" alt="Nginx"></a>
<a href="https://github.com/cdfrm/github-views-count"><img src="https://img.shields.io/badge/docker%20build-automated-066da5?style=for-the-badge" alt="Docker"></a>
<a href="https://github.com/cdfrm/github-views-count"><img src="https://img.shields.io/github/checks-status/cdfrm/github-views-count/master?style=for-the-badge" alt="Php"></a>
<a href="https://github.com/cdfrm/github-views-count"><img src="https://img.shields.io/github/license/cdfrm/github-views-count?style=for-the-badge" alt="Php"></a>

</p>

## Introduction

How many times your GitHub profile has been viewed and displays them in your profile for free.

We can only increment the counter for each request from the GitHub proxy server, we don't know who initiated it.

<img align="center" src="https://cloud.nosense.lol/s/7GzCcHTKowwLoQ4/download/Screenshot%20from%202022-12-02%2016-32-11.png">

## Usage

This is solution-ready-to-use. It was hosted by myself on my little RPi-4. I don't want to call it "Cloud" at all.

### Create GitHub profile repository

Github magic: <a href="https://docs.github.com/en/account-and-profile/setting-up-and-managing-your-github-profile/customizing-your-profile/managing-your-profile-readme">Manage your Profile</a> 

### Embedding ounter to GitHub profile

By adding this Markdown code to your README.md. You can display the view counter anywhere you want.

`![](https://api.nosense.lol/ghvc/?username=your-username)`

Like this:

<img align="center" src="https://cloud.nosense.lol/s/ArTXCPamER5BS9W/download/Screenshot%20%2852%29.png">

### Fact:
All this views could be faked. So don't spam my poor server. You can deploy a standalone solution to draw any views count you want.
This project was built in Docker, it will take less than minutes to deploy it.

#### Step 1: Pull the repo

`git clone https://github.com/cdfrm/github-views-count.git`

### Step 2: Install Docker and Docker Compose 

<a href="https://www.theserverside.com/blog/Coffee-Talk-Java-News-Stories-and-Opinions/How-to-install-Docker-and-docker-compose-on-Ubuntu" >How to install</a>

### Step 3: Run project

`cd github-views-count`

#### To Start:
`make start`

#### To Stop:
`make stop`

### Access:

You can change .env.sample file to use your own config. Current config will work with Docker Built-in Stack.

Access: http://127.0.0.1/ghvc/?username=your-username

<img align="center" src="https://cloud.nosense.lol/s/RmH5nmyD85FJCeW/download/Screenshot%20from%202022-12-02%2017-00-02.png">

DB Access: 
Host: http://127.0.0.1:8080
User Default: root
Password default: root

<img align="center" src="https://cloud.nosense.lol/s/Tbfm4xsyHsQCSmL/download/Screenshot%20from%202022-12-02%2017-03-03.png">

## Personalize Badge

### Color:

You can use any HEX color (without `#` prefix) or predefinded color on this:

<p>![](https://api.nosense.lol/ghvc/?username=your-github-username&color=green)</p>

Or 

<p>![](https://api.nosense.lol/ghvc/?username=your-github-username&color=dc143c)</p>

| color | demo |
| ----- | ---- |
| `brightgreen` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=brightgreen) |
| `green` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=green) |
| `yellow` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=yellow) |
| `yellowgreen` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=yellowgreen) |
| `orange` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=orange) |
| `red` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=red) |
| `blue` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=blue) |
| `grey` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=grey) |
| `lightgrey` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=lightgrey) |
| `blueviolet` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=blueviolet) |
| `ff69b4` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=ff69b4) |

### Label:

By defautl it will be: "Profile Views". You can change this by the 'label' param. Space will be replace by `+`.

<p>![](https://api.nosense.lol/ghvc/?username=your-github-username&label=Custom+Label)</p>

### Styles:

By defautl it will be: "for-the-badge". You can change this by the 'style' param.

<p>![](https://api.nosense.lol/ghvc/?username=your-github-username&style=flat)</p>

| style | demo |
| ----- | ---- |
| `flat` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=007ec6&style=flat) |
| `flat-square` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=007ec6&style=flat-square) |
| `plastic` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=007ec6&style=plastic) |
| `for-the-badge` | ![](https://img.shields.io/static/v1?label=Profile+views&message=1234567890&color=007ec6&style=for-the-badge) |


## License
[GPLv3][gpl] © [Pham Dai][author]

[gpl]:https://www.gnu.org/licenses/gpl-3.0.en.html
[author]:https://www.linkedin.com/in/daipham3101/