/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   parse.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/23 14:09:09 by jmondino          #+#    #+#             */
/*   Updated: 2019/05/29 20:34:00 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

void	ft_parseargs(char **av, t_shit *pShit)
{
	int		i;
	int		j;
	int		bool;
	char	*tmp;
	char	*newav[256];

	i = 0;
	j = 0;
	bool = 0;
	tmp = NULL;
	while (av[++i])
	{
		if (!(ft_strcmp(av[i],  "--")) || av[i][0] != '-')
			bool = 1;
		if (av[i][0] == '-' && bool == 0)
			tmp = ft_strjoin(tmp, ft_checkflags(av[i]));
		else
		{
			newav[j] = av[i];
			j++;
		}
	}
	newav[j] = NULL;
	if (newav[0])
		ft_asciiorder(newav);
	pShit->flags = tmp;
	pShit->files = ft_isfile(newav, j);
	pShit->dirs = ft_isdir(newav, j);
}

char	**ft_isdir(char **newav, int index)
{
	char	**tab;
	int		i;
	int		j;

	if (newav == NULL)
		return (NULL);
	if (!(tab = (char **)malloc(sizeof(char *) * index)))
		return (NULL);
	i = 0;
	j = 0;
	while (newav[i])
	{
		if (ft_strcmp(newav[i],  "--"))
		{
			if (ft_existent(newav[i], 0))
			{
				tab[j] = (char *)malloc(sizeof(char) * ft_strlen(newav[i]));
				tab[j] = newav[i];
				j++;
			}
		}
		i++;
	}
	tab[j] = NULL;
	return (tab);
}

char	**ft_isfile(char **newav, int index)
{
	char	**tab;
	int		i;
	int		j;

	if (newav == NULL)
		return (NULL);
	if (!(tab = (char **)malloc(sizeof(char *) * index)))
		return (NULL);
	i = 0;
	j = 0;
	while (newav[i])
	{
		if (ft_strcmp(newav[i],  "--"))
		{
			if (ft_existent(newav[i], 1))
			{
				tab[j] = (char *)malloc(sizeof(char) * ft_strlen(newav[i]));
				tab[j] = newav[i];
				j++;
			}
		}
		i++;
	}
	tab[j] = NULL;
	return (tab);
}

int		ft_existent(char *str, int here)
{
	DIR		*pDir;

	if (here == 1)
	{
		if ((pDir = opendir(str)) == NULL)
		{
			if (errno == ENOENT)
			{
				printf ("ft_ls: %s: No such file or directory\n", str);
				return (0);
			}
			return (1);
		}
		return (0);
	}
	if ((pDir = opendir(str)) == NULL)
		return (0);
	return (1);
}

char	*ft_checkflags(char *str)
{
	int		i;
	char	*tmp;

	i = 1;
	while (str[i])
	{
		if (!(OP(str[i])))
		{
			printf("ft_ls: illegall option -- %c\n", str[i]);
			printf("usage: ft_ls [-Ralrt] [file ...]\n");
			exit(1);
		}
		i++;
	}
	tmp = str + 1;
	return (tmp);
}



/*
int		checkoption(char *option, char c)
{
	int		i;

	if (option == NULL)
		return (0);
	i = 0;
	while (option[i])
	{
		if (option[i] == c)
			return (1);
		i++;
	}
	return (0);
}

void	ft_revtab(char **tab)
{
	int		i;
	int		j;
	char	*tmp;

	i = 0;
	j = 0;
	while (tab[j])
		j++;
	j--;
	while (i < j)
	{
		tmp = tab[i];
		tab[i] = tab[j];
		tab[j] = tmp;
		i++;
		j--;
	}
}

t_entries  *ft_newlst(char *content, char type)
{
    t_entries  *lst;

    if (!(lst = (t_entries *)malloc(sizeof(t_entries))))
        return (NULL);
    if (content)
    {
        lst->name = ft_strdup((const char *)content);
        lst->type = type;
    }
    else
    {
        lst->name = NULL;
        lst->type = '\0';
    }
    lst->next = NULL;
    return (lst);
}


void    ft_addlst(t_entries **alist, t_entries *new)
{
    new->next = *alist;
    *alist = new;
}
*/
