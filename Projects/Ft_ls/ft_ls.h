/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/20 16:58:28 by jmondino          #+#    #+#             */
/*   Updated: 2019/05/29 20:38:03 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
# define FT_LS_H

# include <stdio.h>
# include <dirent.h>
# include <stdlib.h>
# include <sys/types.h> 
# include <sys/stat.h> 
# include <unistd.h>
# include "libft/libft.h"
# include <errno.h>
# define OP(x) x == 'a' || x == 'r' || x == 'l' || x == 'R' || x == 't'

typedef struct 		s_shit
{
	char			*flags;
	char			**files;
	char			**dirs;
}					t_shit;

typedef struct  	s_entry
{
    char        	*name;
    char        	*rights;
    int         	hard_links;
    char        	*user;
    char        	*group;
    int         	size;
    char        	*date_month_modified;
    int         	date_day_modified;
    char        	*date_time_modified;
    char        	*date_month_created;
    int         	date_day_created;
    char        	*date_time_created;
    char        	*date_month_accessed;
    int         	date_day_accessed;
    char        	*date_time_accessed;
	struct s_entry 	*next;
}               	t_entry;

void		ft_pathless(DIR *pDir, struct dirent *pDirent, t_shit *pShit);
void		ft_manypaths(DIR *pDir, struct dirent *pDirent, t_shit *pShit);
void		ft_parse(DIR *pDir, struct dirent *pDirent, t_shit *pShit);
void		ft_afftab(char **tab);
void		ft_asciiorder(char **tab);
void		ft_revtab(char **tab);
void		ft_addlst(t_entry **alist, t_entry *new);
void		ft_parseargs(char **av, t_shit *pShit);
char		*ft_parseflags(char *str);
char		*ft_checkflags(char *str);
char		**ft_lstotab(t_list *lst, int i);
char		**ft_isfile(char **newav, int index);
char		**ft_isdir(char **newav, int index);
int			checkoption(char *option, char c);
int			ft_existent(char *str, int here);
t_entry		*ft_newlst(char *content, char type);

#endif
