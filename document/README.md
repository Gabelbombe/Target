### How to run

Make sure you have vagrant installed 
now: `vagrant up`


### What

The goal of this exercise is to create a working program in Java to search relevant

documents / files for the given search term or phrase (single token), and return results 

in order of relevance. Relevancy is defined as number of times the exact term or 

phrase appears in the document.

We have attached 3 files for your program to read and use as sample search content. Your 

project should allow the user to enter a search term or phrase at the command-line, execute 

the search, and return results. For example:

Enter the search term: <user enters search term>

Search results:

<sample results start:

File2.txt – X matches

File1.txt - X matches

File3.txt – X matches

>

Enter the search term: <user enters search term>

For this project, create a modular “searcher” class to execute the search against the content. 

You will have to create 3 iterations of this “searcher,” each with a different approach:

- Brute-force text searcher

- Text search using the regex API in Java

- Create an “index” of content using a data structure, like a hash map or binary tree.

- Write unit tests for each method

- Run a performance test that does 2M searches with random search terms, and 

measures execution time. Which approach is fastest? Why?

- Provide some thoughts on what you would do on the software or hardware side to 

make this program scale to handle massive content and/or very large request volume 

(5000 requests/second or more).

Deliverables

1. Working program and tests

2. Performance results and analysis

3. Thoughts on scalability
