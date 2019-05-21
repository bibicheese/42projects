/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/20 16:58:28 by jmondino          #+#    #+#             */
/*   Updated: 2019/05/21 23:18:00 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
#define FT_LS_H

#include <stdio.h>
#include <dirent.h>
#include <stdlib.h>
#include "libft/libft.h"

void	ft_oneac(DIR *pDir, struct dirent *pDirent);
void	ft_manyac(DIR *pDir, struct dirent *pDirent, int ac, char **av);
void	ft_parse(DIR *pDir, struct dirent *pDirent);
void	ft_afftab(char **tab);
void	ft_tritab(char **tab);
char	**ft_creatab(t_list *lst, int i);


#endif
