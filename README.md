# Great task for Great Fullstack Developer

### Description

This task was done by developing Backend REST API for potential use on Frontend side (as client). It is possible to fetch any repository issues from Github through developed API endpoints.  

### <a name="requirements"></a>Requirements

* docker: `>=18.x-ce` 
* docker-compose: `>=1.20.1`

### <a name="how-to-run"></a>How to Run dev environment:

```bash
  $ git clone <project>  
  $ cd path/to/<project>
```
Change `GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET` values in `.env` file

```bash
  $ ./testio.sh up 
```
Open `http://localhost:8000/`

### Implemented endpoints

* List Issues: `[GET] /api/issues/{repositoryOwner}/{repositoryName}/{page}`
* Get Issue `[GET] /api/issue/{repositoryOwner}/{repositoryName}/{issueNumber}`

### Examples

You may check API examples through logging in dev environment.
